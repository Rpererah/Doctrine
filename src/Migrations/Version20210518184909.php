<?php

declare(strict_types=1);

namespace Alura\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518184909 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__Curso AS SELECT id, nome FROM Curso');
        $this->addSql('DROP TABLE Curso');
        $this->addSql('CREATE TABLE Curso (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO Curso (id, nome) SELECT id, nome FROM __temp__Curso');
        $this->addSql('DROP TABLE __temp__Curso');
        $this->addSql('DROP INDEX IDX_6F96721A87CB4A1F');
        $this->addSql('DROP INDEX IDX_6F96721AB2DDF7F4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__curso_aluno AS SELECT curso_id, aluno_id FROM curso_aluno');
        $this->addSql('DROP TABLE curso_aluno');
        $this->addSql('CREATE TABLE curso_aluno (aluno_id INTEGER NOT NULL, curso_id INTEGER NOT NULL, PRIMARY KEY(curso_id, aluno_id), CONSTRAINT FK_6F96721A87CB4A1F FOREIGN KEY (curso_id) REFERENCES Curso (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6F96721AB2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES Aluno (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO curso_aluno (curso_id, aluno_id) SELECT curso_id, aluno_id FROM __temp__curso_aluno');
        $this->addSql('DROP TABLE __temp__curso_aluno');
        $this->addSql('CREATE INDEX IDX_6F96721A87CB4A1F ON curso_aluno (curso_id)');
        $this->addSql('CREATE INDEX IDX_6F96721AB2DDF7F4 ON curso_aluno (aluno_id)');
        $this->addSql('DROP INDEX IDX_D8448137B2DDF7F4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__Telefone AS SELECT id, aluno_id, numero FROM Telefone');
        $this->addSql('DROP TABLE Telefone');
        $this->addSql('CREATE TABLE Telefone (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, aluno_id INTEGER DEFAULT NULL, numero VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_D8448137B2DDF7F4 FOREIGN KEY (aluno_id) REFERENCES Aluno (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO Telefone (id, aluno_id, numero) SELECT id, aluno_id, numero FROM __temp__Telefone');
        $this->addSql('DROP TABLE __temp__Telefone');
        $this->addSql('CREATE INDEX IDX_D8448137B2DDF7F4 ON Telefone (aluno_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__Curso AS SELECT id, nome FROM Curso');
        $this->addSql('DROP TABLE Curso');
        $this->addSql('CREATE TABLE Curso (nome VARCHAR(255) NOT NULL, id VARCHAR(255) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO Curso (id, nome) SELECT id, nome FROM __temp__Curso');
        $this->addSql('DROP TABLE __temp__Curso');
        $this->addSql('DROP INDEX IDX_D8448137B2DDF7F4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__Telefone AS SELECT id, aluno_id, numero FROM Telefone');
        $this->addSql('DROP TABLE Telefone');
        $this->addSql('CREATE TABLE Telefone (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, aluno_id INTEGER DEFAULT NULL, numero VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO Telefone (id, aluno_id, numero) SELECT id, aluno_id, numero FROM __temp__Telefone');
        $this->addSql('DROP TABLE __temp__Telefone');
        $this->addSql('CREATE INDEX IDX_D8448137B2DDF7F4 ON Telefone (aluno_id)');
        $this->addSql('DROP INDEX IDX_6F96721A87CB4A1F');
        $this->addSql('DROP INDEX IDX_6F96721AB2DDF7F4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__curso_aluno AS SELECT curso_id, aluno_id FROM curso_aluno');
        $this->addSql('DROP TABLE curso_aluno');
        $this->addSql('CREATE TABLE curso_aluno (aluno_id INTEGER NOT NULL, curso_id VARCHAR(255) NOT NULL COLLATE BINARY, PRIMARY KEY(curso_id, aluno_id))');
        $this->addSql('INSERT INTO curso_aluno (curso_id, aluno_id) SELECT curso_id, aluno_id FROM __temp__curso_aluno');
        $this->addSql('DROP TABLE __temp__curso_aluno');
        $this->addSql('CREATE INDEX IDX_6F96721A87CB4A1F ON curso_aluno (curso_id)');
        $this->addSql('CREATE INDEX IDX_6F96721AB2DDF7F4 ON curso_aluno (aluno_id)');
    }
}
