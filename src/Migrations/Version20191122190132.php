<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191122190132 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE voltaire_bareme (id INT AUTO_INCREMENT NOT NULL, nom_bareme VARCHAR(255) NOT NULL, favori_bareme INT NOT NULL, id_bareme INT NOT NULL, id_critere INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_enseignant (id INT AUTO_INCREMENT NOT NULL, nom_enseignant VARCHAR(255) NOT NULL, prenom_enseignant VARCHAR(255) NOT NULL, groupe_enseignant VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, id_enseignant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_etudiant (id INT AUTO_INCREMENT NOT NULL, id_etudiant VARCHAR(255) NOT NULL, nom_etudiant VARCHAR(255) NOT NULL, prenom_etudiant VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, id_bareme INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_modules (id INT AUTO_INCREMENT NOT NULL, id_module INT NOT NULL, nom_module VARCHAR(255) NOT NULL, nb_regles_module INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_niveau (id INT AUTO_INCREMENT NOT NULL, id_niveau INT NOT NULL, nom_niveau VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_resultat_niveau (id INT AUTO_INCREMENT NOT NULL, id_etudiant VARCHAR(255) NOT NULL, id_niveau INT NOT NULL, derniere_utilisation DATE NOT NULL, tps_total TIME NOT NULL, niveau_atteint INT NOT NULL, score_evaluation INT NOT NULL, note INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_resultats (id INT AUTO_INCREMENT NOT NULL, id_etudiant VARCHAR(255) NOT NULL, id_module INT NOT NULL, inscription DATE NOT NULL, derniere_utilisation DATE NOT NULL, tps_total TIME NOT NULL, usage_fixe VARCHAR(255) NOT NULL, usage_mobile VARCHAR(255) NOT NULL, score_evaluation INT NOT NULL, tps_evaluation_initiale TIME NOT NULL, niveau_initial INT NOT NULL, tps_entrainement TIME NOT NULL, niveau_atteint INT NOT NULL, date_cv DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE voltaire_bareme');
        $this->addSql('DROP TABLE voltaire_enseignant');
        $this->addSql('DROP TABLE voltaire_etudiant');
        $this->addSql('DROP TABLE voltaire_modules');
        $this->addSql('DROP TABLE voltaire_niveau');
        $this->addSql('DROP TABLE voltaire_resultat_niveau');
        $this->addSql('DROP TABLE voltaire_resultats');
        $this->addSql('DROP TABLE voltaire_user');
    }
}
