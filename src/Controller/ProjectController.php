<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Project;
use App\Dto\CreateProjectDto;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProjectController extends AbstractController
{

    private $validator;

    // Injecting ValidatorInterface into the constructor
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    // Projects function (returning a JSON response of projects retrieved from MySQL DB)
    #[Route('/projects', name: 'app_projects', methods: ['GET'])]
    public function projects(EntityManagerInterface $em): JsonResponse
    {
        // Retrieve all projects from the database
        $projects = $em->getRepository(Project::class)->findBy([], ['id' => 'DESC']);

        // If there are no projects, return an empty array
        $data = [];
        foreach ($projects as $project) {
            $data[] = [
                'id' => $project->getId(),
                'name' => $project->getName(),
                'description' => $project->getDescription(),
                'contractTypeId' => $project->getContractTypeId(),
                'contractSignedOn' => $project->getContractSignedOn(),
                'budget' => $project->getBudget(),
            ];
        }

        return new JsonResponse([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    // Project detail function (returning a JSON response of a single project by ID)
    #[Route('/projects/{id}', name: 'app_project_detail', methods: ['GET'])]
    public function projectDetail(EntityManagerInterface $em, int $id): JsonResponse
    {
        // Retrieve the project by ID
        $project = $em->getRepository(Project::class)->find($id);

        // If the project is not found, return an error response
        if (!$project) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'Project not found',
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        // Prepare the project data
        $data = [
            'id' => $project->getId(),
            'name' => $project->getName(),
            'description' => $project->getDescription(),
            'contractTypeId' => $project->getContractTypeId(),
            'contractSignedOn' => $project->getContractSignedOn(),
            'budget' => $project->getBudget(),
            'isActive' => $project->getIsActive(),
        ];

        return new JsonResponse([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    // Create new project function (via POST request)
    /**
     * 
     * curl -X POST http://localhost:8001/projects -H "Content-Type: application/json" -d '{"name":"New Project","description":"This is a new project.","contractTypeId":101,"contractSignedOn":"2024-01-01","budget":50000,"isActive":1}'
     * 
     */
    #[Route('/projects', name: 'create_project', methods: ['POST'])]
    public function createProject(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): JsonResponse
    {
        // Decode the incoming JSON request
        $data = json_decode($request->getContent(), true);

        // Create a new DTO and populate it with the request data
        $createProjectDto = new CreateProjectDto();
        $createProjectDto->setName($data['name'] ?? null);
        $createProjectDto->setDescription($data['description'] ?? null);
        $createProjectDto->setContractTypeId($data['contractTypeId'] ?? null);
        $createProjectDto->setContractSignedOn($data['contractSignedOn'] ?? null);
        $createProjectDto->setBudget($data['budget'] ?? null);
        $createProjectDto->setIsActive($data['isActive'] ?? null);

        // Validate the DTO
        $errors = $validator->validate($createProjectDto);

        // If validation fails, return errors
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }

            return new JsonResponse([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $errorMessages
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        // If validation passes, create the Project entity
        $project = new Project();
        $project->setName($createProjectDto->getName());
        $project->setDescription($createProjectDto->getDescription());
        $project->setContractTypeId($createProjectDto->getContractTypeId());
        $project->setContractSignedOn($createProjectDto->getContractSignedOn());
        $project->setBudget($createProjectDto->getBudget());
        $project->setIsActive($createProjectDto->getIsActive());

        // Persist the project
        $em->persist($project);
        $em->flush();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Project created successfully!'
        ], JsonResponse::HTTP_CREATED);
    }

}
