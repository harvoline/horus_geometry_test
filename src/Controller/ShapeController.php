<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Circle;
use App\Entity\Triangle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ShapeController extends AbstractController
{
    public function triangle(Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();

        $side_a = (float) $request->get("side_a");
        $side_b = (float) $request->get("side_b");
        $side_c = (float) $request->get("side_c");

        $input = [
            'side_a' => $side_a,
            'side_b' => $side_b,
            'side_c' => $side_c,
        ];
        
        // dd($input);

        $constraints = new Assert\Collection([
            'side_a' => [new Assert\NotNull, new Assert\NotBlank, new Assert\Required, new Assert\Regex([
                'pattern' => '/\d+/i',
            ])],
            'side_b' => [new Assert\NotNull, new Assert\NotBlank, new Assert\Required, new Assert\Regex([
                'pattern' => '/\d+/i',
            ])],
            'side_c' => [new Assert\NotNull, new Assert\NotBlank, new Assert\Required, new Assert\Regex([
                'pattern' => '/\d+/i',
            ])],
        ]);
        
        $violations = $validator->validate($input, $constraints);

        if (count($violations) > 0) {
            $accessor = PropertyAccess::createPropertyAccessor();

            $errorMessages = [];

            foreach ($violations as $violation) {

                $accessor->setValue($errorMessages,
                    $violation->getPropertyPath(),
                    $violation->getMessage());
            }

            return $this->json($errorMessages);
        }

        $triangle = new Triangle($side_a, $side_b, $side_c);

        // return $this->json([
        //     'type' => $triangle->type,
        //     'a' => $triangle->getSideA(),
        //     'b' => $triangle->getSideB(),
        //     'c' => $triangle->getSideC(),
        //     'surface' => $triangle->getSurface(),
        //     'circumference' => $triangle->getCircumference(),
        // ]);

        return $this->json($triangle->getTriangleData());
    }

    public function circle(Request $request, ValidatorInterface $validator, ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();

        $radius = (float) $request->get("radius");

        $input = [
            'radius' => $radius,
        ];
        
        // dd($input);

        $constraints = new Assert\Collection([
            'radius' => [new Assert\NotNull, new Assert\NotBlank, new Assert\Required, new Assert\Regex([
                'pattern' => '/\d+/i',
            ])],
        ]);
        
        $violations = $validator->validate($input, $constraints);

        if (count($violations) > 0) {
            $accessor = PropertyAccess::createPropertyAccessor();

            $errorMessages = [];

            foreach ($violations as $violation) {

                $accessor->setValue($errorMessages,
                    $violation->getPropertyPath(),
                    $violation->getMessage());
            }

            return $this->json($errorMessages);
        }

        $circle = new Circle($radius);

        // return $this->json([
        //     'type' => $circle->type,
        //     'radius' => $circle->getRadius(),
        //     'surface' => $circle->getSurface(),
        //     'circumference' => $circle->getCircumference(),
        // ]);

        return $this->json($circle->getCircleData());
    }

    public function sumArea(Request $request, ContainerInterface  $container)
    {
        $geometryService = $container->get('app.geometry_calculator');

        $triangle = new Triangle(3, 4, 5);
        $circle = new Circle(2);

        $area = $geometryService->calculateArea($triangle, $circle);

        return $this->json([
            'total_area' => $area,
        ]);
    }

    public function sumDiameter(Request $request, ContainerInterface  $container)
    {
        $geometryService = $container->get('app.geometry_calculator');

        $triangle = new Triangle(3, 4, 5);
        $circle = new Circle(2);

        $circumference = $geometryService->calculateDiameter($triangle, $circle);

        return $this->json([
            'total_circumference' => $circumference,
        ]);
    }

}