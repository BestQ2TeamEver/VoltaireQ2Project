<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191122002100 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ttv_commandes DROP FOREIGN KEY FK_DF2093ECA455ACCF');
        $this->addSql('ALTER TABLE ttv_commandes DROP FOREIGN KEY FK_DF2093EC5C8C21CF');
        $this->addSql('DROP TABLE bareme');
        $this->addSql('DROP TABLE passager');
        $this->addSql('DROP TABLE trajet');
        $this->addSql('DROP TABLE ttv_clients');
        $this->addSql('DROP TABLE ttv_commandes');
        $this->addSql('DROP TABLE ttv_listeoptions');
        $this->addSql('DROP TABLE ttv_options');
        $this->addSql('DROP TABLE ttv_voyages');
        $this->addSql('ALTER TABLE utilisateur CHANGE login login VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE voiture CHANGE immatriculation immatriculation VARCHAR(8) NOT NULL');
        $this->addSql('ALTER TABLE voltaire_enseignant DROP FOREIGN KEY fk_loginEnseignant');
        $this->addSql('ALTER TABLE voltaire_enseignant CHANGE login login VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE voltaire_enseignant ADD CONSTRAINT FK_F9789D33AA08CB10 FOREIGN KEY (login) REFERENCES voltaire_user (login)');
        $this->addSql('ALTER TABLE voltaire_etudiant DROP FOREIGN KEY fk_idBareme');
        $this->addSql('ALTER TABLE voltaire_etudiant DROP FOREIGN KEY fk_loginEtu');
        $this->addSql('ALTER TABLE voltaire_etudiant CHANGE login login VARCHAR(255) DEFAULT NULL, CHANGE idEtudiant idEtudiant VARCHAR(255) NOT NULL, CHANGE idBareme idBareme INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voltaire_etudiant ADD CONSTRAINT FK_765B04B511C1874 FOREIGN KEY (idBareme) REFERENCES voltaire_bareme (idBareme)');
        $this->addSql('ALTER TABLE voltaire_etudiant ADD CONSTRAINT FK_765B04BAA08CB10 FOREIGN KEY (login) REFERENCES voltaire_user (login)');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau DROP FOREIGN KEY fk_idNiv');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau DROP FOREIGN KEY fk_idEtuNiveau');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau DROP FOREIGN KEY fk_idNiv');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau DROP derniereUtilisation, DROP tpsTotal, DROP niveauAtteint, DROP scoreEvaluation, DROP note');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau ADD CONSTRAINT FK_5EC0FCA422DD08B8 FOREIGN KEY (idEtudiant) REFERENCES voltaire_etudiant (idEtudiant)');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau ADD CONSTRAINT FK_5EC0FCA428CE5BF1 FOREIGN KEY (idNiveau) REFERENCES voltaire_niveau (idNiveau)');
        $this->addSql('DROP INDEX fk_idniv ON voltaire_resultat_niveau');
        $this->addSql('CREATE INDEX IDX_5EC0FCA428CE5BF1 ON voltaire_resultat_niveau (idNiveau)');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau ADD CONSTRAINT fk_idNiv FOREIGN KEY (idNiveau) REFERENCES voltaire_niveau (idNiveau) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voltaire_resultats DROP FOREIGN KEY fk_idEtu');
        $this->addSql('ALTER TABLE voltaire_resultats DROP FOREIGN KEY fk_idmod');
        $this->addSql('ALTER TABLE voltaire_resultats DROP FOREIGN KEY fk_idmod');
        $this->addSql('ALTER TABLE voltaire_resultats DROP inscription, DROP derniereUtilisation, DROP tpsTotal, DROP usageFixe, DROP usageMobile, DROP scoreEvaluation, DROP tpsEvaluationInitiale, DROP niveauInitial, DROP tpsEntrainement, DROP niveauAtteint, DROP dateCV');
        $this->addSql('ALTER TABLE voltaire_resultats ADD CONSTRAINT FK_8D96A74A22DD08B8 FOREIGN KEY (idEtudiant) REFERENCES voltaire_etudiant (idEtudiant)');
        $this->addSql('ALTER TABLE voltaire_resultats ADD CONSTRAINT FK_8D96A74A6F358EB2 FOREIGN KEY (idModule) REFERENCES voltaire_modules (idModule)');
        $this->addSql('DROP INDEX fk_idmod ON voltaire_resultats');
        $this->addSql('CREATE INDEX IDX_8D96A74A6F358EB2 ON voltaire_resultats (idModule)');
        $this->addSql('ALTER TABLE voltaire_resultats ADD CONSTRAINT fk_idmod FOREIGN KEY (idModule) REFERENCES voltaire_modules (idModule) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voltaire_niveau CHANGE idNiveau idNiveau INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE voltaire_user CHANGE login login VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bareme (id INT AUTO_INCREMENT NOT NULL, param1 INT NOT NULL, param2 INT NOT NULL, param3 INT NOT NULL, param4 INT NOT NULL, param5 INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE passager (trajet_id INT NOT NULL, utilisateur_login VARCHAR(32) NOT NULL COLLATE utf8_general_ci, INDEX trajet_id (trajet_id), INDEX utilisateur_login (utilisateur_login), PRIMARY KEY(trajet_id, utilisateur_login)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE trajet (id INT AUTO_INCREMENT NOT NULL, conducteur_login VARCHAR(20) DEFAULT NULL COLLATE utf8_general_ci, depart VARCHAR(20) NOT NULL COLLATE utf8_general_ci, arrivee VARCHAR(20) NOT NULL COLLATE utf8_general_ci, date DATE NOT NULL, nb_places INT NOT NULL, prix INT NOT NULL, INDEX conducteur_login (conducteur_login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ttv_clients (idClient INT AUTO_INCREMENT NOT NULL, nomClient VARCHAR(32) NOT NULL COLLATE utf8_general_ci, prenomClient VARCHAR(32) NOT NULL COLLATE utf8_general_ci, emailClient VARCHAR(32) NOT NULL COLLATE utf8_general_ci, loginClient VARCHAR(32) NOT NULL COLLATE utf8_general_ci, passwordClient VARCHAR(32) NOT NULL COLLATE utf8_general_ci, PRIMARY KEY(idClient)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ttv_commandes (idCommande INT AUTO_INCREMENT NOT NULL, idClient INT DEFAULT NULL, idVoyage INT DEFAULT NULL, dateCommande DATE NOT NULL, dateDebutVoyageCommande DATE NOT NULL, INDEX ce_voyage (idVoyage), INDEX ce_client (idClient), INDEX idCommande (idCommande), PRIMARY KEY(idCommande)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ttv_listeoptions (idCommande INT NOT NULL, idOption INT NOT NULL, INDEX ce_option (idOption), PRIMARY KEY(idCommande, idOption)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ttv_options (idOption INT AUTO_INCREMENT NOT NULL, intituleOption VARCHAR(32) NOT NULL COLLATE utf8_general_ci, prixOption INT NOT NULL, PRIMARY KEY(idOption)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ttv_voyages (idVoyage INT AUTO_INCREMENT NOT NULL, intituleVoyage VARCHAR(32) NOT NULL COLLATE utf8_general_ci, prixVoyage INT NOT NULL, PRIMARY KEY(idVoyage)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98CF1B4A132 FOREIGN KEY (conducteur_login) REFERENCES utilisateur (login)');
        $this->addSql('ALTER TABLE ttv_commandes ADD CONSTRAINT FK_DF2093EC5C8C21CF FOREIGN KEY (idVoyage) REFERENCES ttv_voyages (idVoyage)');
        $this->addSql('ALTER TABLE ttv_commandes ADD CONSTRAINT FK_DF2093ECA455ACCF FOREIGN KEY (idClient) REFERENCES ttv_clients (idClient)');
        $this->addSql('ALTER TABLE utilisateur CHANGE login login VARCHAR(20) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE voiture CHANGE immatriculation immatriculation VARCHAR(8) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE voltaire_enseignant DROP FOREIGN KEY FK_F9789D33AA08CB10');
        $this->addSql('ALTER TABLE voltaire_enseignant CHANGE login login VARCHAR(255) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('ALTER TABLE voltaire_enseignant ADD CONSTRAINT fk_loginEnseignant FOREIGN KEY (login) REFERENCES voltaire_user (login) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voltaire_etudiant DROP FOREIGN KEY FK_765B04B511C1874');
        $this->addSql('ALTER TABLE voltaire_etudiant DROP FOREIGN KEY FK_765B04BAA08CB10');
        $this->addSql('ALTER TABLE voltaire_etudiant CHANGE login login VARCHAR(255) NOT NULL COLLATE utf8_general_ci, CHANGE idEtudiant idEtudiant VARCHAR(255) NOT NULL COLLATE utf8_general_ci, CHANGE idBareme idBareme INT NOT NULL');
        $this->addSql('ALTER TABLE voltaire_etudiant ADD CONSTRAINT fk_idBareme FOREIGN KEY (idBareme) REFERENCES voltaire_bareme (idBareme) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voltaire_etudiant ADD CONSTRAINT fk_loginEtu FOREIGN KEY (login) REFERENCES voltaire_user (login) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voltaire_niveau CHANGE idNiveau idNiveau INT NOT NULL');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau DROP FOREIGN KEY FK_5EC0FCA422DD08B8');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau DROP FOREIGN KEY FK_5EC0FCA428CE5BF1');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau DROP FOREIGN KEY FK_5EC0FCA428CE5BF1');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau ADD derniereUtilisation DATE NOT NULL, ADD tpsTotal TIME NOT NULL, ADD niveauAtteint INT NOT NULL, ADD scoreEvaluation INT NOT NULL, ADD note INT NOT NULL');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau ADD CONSTRAINT fk_idNiv FOREIGN KEY (idNiveau) REFERENCES voltaire_niveau (idNiveau) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau ADD CONSTRAINT fk_idEtuNiveau FOREIGN KEY (idEtudiant) REFERENCES voltaire_etudiant (idEtudiant) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_5ec0fca428ce5bf1 ON voltaire_resultat_niveau');
        $this->addSql('CREATE INDEX fk_idNiv ON voltaire_resultat_niveau (idNiveau)');
        $this->addSql('ALTER TABLE voltaire_resultat_niveau ADD CONSTRAINT FK_5EC0FCA428CE5BF1 FOREIGN KEY (idNiveau) REFERENCES voltaire_niveau (idNiveau)');
        $this->addSql('ALTER TABLE voltaire_resultats DROP FOREIGN KEY FK_8D96A74A22DD08B8');
        $this->addSql('ALTER TABLE voltaire_resultats DROP FOREIGN KEY FK_8D96A74A6F358EB2');
        $this->addSql('ALTER TABLE voltaire_resultats DROP FOREIGN KEY FK_8D96A74A6F358EB2');
        $this->addSql('ALTER TABLE voltaire_resultats ADD inscription DATE NOT NULL, ADD derniereUtilisation DATE NOT NULL, ADD tpsTotal TIME NOT NULL, ADD usageFixe VARCHAR(255) NOT NULL COLLATE utf8_general_ci, ADD usageMobile VARCHAR(255) NOT NULL COLLATE utf8_general_ci, ADD scoreEvaluation INT NOT NULL, ADD tpsEvaluationInitiale TIME NOT NULL, ADD niveauInitial INT NOT NULL, ADD tpsEntrainement TIME NOT NULL, ADD niveauAtteint INT NOT NULL, ADD dateCV DATE NOT NULL');
        $this->addSql('ALTER TABLE voltaire_resultats ADD CONSTRAINT fk_idEtu FOREIGN KEY (idEtudiant) REFERENCES voltaire_etudiant (idEtudiant) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voltaire_resultats ADD CONSTRAINT fk_idmod FOREIGN KEY (idModule) REFERENCES voltaire_modules (idModule) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_8d96a74a6f358eb2 ON voltaire_resultats');
        $this->addSql('CREATE INDEX fk_idmod ON voltaire_resultats (idModule)');
        $this->addSql('ALTER TABLE voltaire_resultats ADD CONSTRAINT FK_8D96A74A6F358EB2 FOREIGN KEY (idModule) REFERENCES voltaire_modules (idModule)');
        $this->addSql('ALTER TABLE voltaire_user CHANGE login login VARCHAR(255) NOT NULL COLLATE utf8_general_ci');
    }
}
