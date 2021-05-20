<?php

use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();



$classeAluno=Aluno::class;
$dql="SELECT COUNT(aluno) FROM $classeAluno aluno";
$query=$entityManager->createQuery($dql);
$totalAlunos=$query->getSingleScalarResult();
echo "total de alunos: ".$totalAlunos;