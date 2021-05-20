<?php


use Alura\Doctrine\Entity\Aluno;
use Alura\Doctrine\Entity\Curso;
use Alura\Doctrine\Entity\Telefone;
use Alura\Doctrine\Helper\EntityManagerFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$alunosRepository = $entityManager->getRepository(Aluno::class);

$debugStack = new \Doctrine\DBAL\Logging\DebugStack();
$entityManager->getConfiguration()->setSQLLogger($debugStack);

/**
 * @var Aluno[] $alunos
 */
$alunos = $alunosRepository->findAll();

foreach ($alunos as $aluno) {
    $telefones = $aluno->getTelefone()->map(function (Telefone $telefone) {
        return $telefone->getNumero();
    })->toArray();
    echo "Id: {$aluno->getId()}\n";
    echo "Nome: {$aluno->getNome()}\n";
    echo "Telefones " . implode(",", $telefones) . PHP_EOL;

    $cursos = $aluno->getCursos();
    foreach ($cursos as $curso) {
        echo "\tID Curso: {$curso->getId()}\n";
        echo "\tCurso Nomw: {$curso->getNome()}\n";
        echo PHP_EOL;
    }
    echo PHP_EOL;
}

echo PHP_EOL;
print_r($debugStack);
foreach ($debugStack->queries as $queryInfo) {
    echo $queryInfo['sql'] . PHP_EOL;
}