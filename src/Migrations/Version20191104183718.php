<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191104183718 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, sphere VARCHAR(255) NOT NULL, groupe VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, identifiant VARCHAR(255) NOT NULL, inscription VARCHAR(255) NOT NULL, module VARCHAR(255) NOT NULL, derniereutilisation VARCHAR(255) NOT NULL, tempstotal VARCHAR(255) NOT NULL, usagefixe VARCHAR(255) NOT NULL, usagemobile VARCHAR(255) NOT NULL, score_evalutation_initiale VARCHAR(255) NOT NULL, temps_evaluation_initiale VARCHAR(255) NOT NULL, niveau_initial VARCHAR(255) NOT NULL, temps_entrainement VARCHAR(255) NOT NULL, niveau_atteint VARCHAR(255) NOT NULL, date_cv VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE etudiant');
    }
}
