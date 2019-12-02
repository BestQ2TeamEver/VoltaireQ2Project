<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191202183615 extends AbstractMigration
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
        $this->addSql('ALTER TABLE trajet DROP FOREIGN KEY FK_2B5BA98CF1B4A132');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_bareme (id INT AUTO_INCREMENT NOT NULL, nom_bareme VARCHAR(255) NOT NULL, favori_bareme INT NOT NULL, id_critere INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_critere (id_critere INT AUTO_INCREMENT NOT NULL, progression VARCHAR(255) NOT NULL, tps_utilisation VARCHAR(255) NOT NULL, niveau_atteint VARCHAR(255) NOT NULL, evaluation_finale INT NOT NULL, PRIMARY KEY(id_critere)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_enseignant (id INT AUTO_INCREMENT NOT NULL, nom_enseignant VARCHAR(255) NOT NULL, prenom_enseignant VARCHAR(255) NOT NULL, groupe_enseignant VARCHAR(255) NOT NULL, login VARCHAR(255) NOT NULL, id_enseignant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_etudiant (login VARCHAR(255) NOT NULL, nom_etudiant VARCHAR(255) NOT NULL, prenom_etudiant VARCHAR(255) NOT NULL, id_bareme INT NOT NULL, PRIMARY KEY(login)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_modules (id_module INT NOT NULL, nom_module VARCHAR(255) NOT NULL, nb_regles_module INT NOT NULL, PRIMARY KEY(id_module)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_niveau (id_niveau INT NOT NULL, nom_niveau VARCHAR(255) NOT NULL, PRIMARY KEY(id_niveau)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_resultat_niveau (id_etudiant VARCHAR(255) NOT NULL, id_niveau VARCHAR(255) NOT NULL, derniere_utilisation DATE NOT NULL, tps_total TIME NOT NULL, niveau_atteint INT NOT NULL, score_evaluation INT NOT NULL, note INT NOT NULL, PRIMARY KEY(id_etudiant, id_niveau)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_resultats (id_etudiant VARCHAR(255) NOT NULL, id_module INT NOT NULL, inscription DATE NOT NULL, derniere_utilisation DATE NOT NULL, tps_total TIME NOT NULL, usage_fixe VARCHAR(255) NOT NULL, usage_mobile VARCHAR(255) NOT NULL, score_evaluation_initiale INT NOT NULL, tps_evaluation_initiale TIME NOT NULL, niveau_initial INT NOT NULL, tps_entrainement TIME NOT NULL, niveau_atteint INT NOT NULL, date_cv DATE NOT NULL, PRIMARY KEY(id_etudiant, id_module)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voltaire_user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE bareme');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE passager');
        $this->addSql('DROP TABLE trajet');
        $this->addSql('DROP TABLE ttv_clients');
        $this->addSql('DROP TABLE ttv_commandes');
        $this->addSql('DROP TABLE ttv_listeoptions');
        $this->addSql('DROP TABLE ttv_options');
        $this->addSql('DROP TABLE ttv_voyages');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE voiture');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bareme (id INT AUTO_INCREMENT NOT NULL, param1 INT NOT NULL, param2 INT NOT NULL, param3 INT NOT NULL, param4 INT NOT NULL, param5 INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, identifiant VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, prenom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, sphere VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, module VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, derniere_connexion VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, niveau VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, temps_entrainement VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, temps_total VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci, inscription VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE passager (trajet_id INT NOT NULL, utilisateur_login VARCHAR(32) NOT NULL COLLATE utf8_general_ci, INDEX trajet_id (trajet_id), INDEX utilisateur_login (utilisateur_login), PRIMARY KEY(trajet_id, utilisateur_login)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE trajet (id INT AUTO_INCREMENT NOT NULL, conducteur_login VARCHAR(20) DEFAULT NULL COLLATE utf8_general_ci, depart VARCHAR(20) NOT NULL COLLATE utf8_general_ci, arrivee VARCHAR(20) NOT NULL COLLATE utf8_general_ci, date DATE NOT NULL, nb_places INT NOT NULL, prix INT NOT NULL, INDEX conducteur_login (conducteur_login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ttv_clients (idClient INT AUTO_INCREMENT NOT NULL, nomClient VARCHAR(32) NOT NULL COLLATE utf8_general_ci, prenomClient VARCHAR(32) NOT NULL COLLATE utf8_general_ci, emailClient VARCHAR(32) NOT NULL COLLATE utf8_general_ci, loginClient VARCHAR(32) NOT NULL COLLATE utf8_general_ci, passwordClient VARCHAR(32) NOT NULL COLLATE utf8_general_ci, PRIMARY KEY(idClient)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ttv_commandes (idCommande INT AUTO_INCREMENT NOT NULL, idClient INT DEFAULT NULL, idVoyage INT DEFAULT NULL, dateCommande DATE NOT NULL, dateDebutVoyageCommande DATE NOT NULL, INDEX ce_client (idClient), INDEX ce_voyage (idVoyage), INDEX idCommande (idCommande), PRIMARY KEY(idCommande)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ttv_listeoptions (idCommande INT NOT NULL, idOption INT NOT NULL, INDEX ce_option (idOption), PRIMARY KEY(idCommande, idOption)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ttv_options (idOption INT AUTO_INCREMENT NOT NULL, intituleOption VARCHAR(32) NOT NULL COLLATE utf8_general_ci, prixOption INT NOT NULL, PRIMARY KEY(idOption)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ttv_voyages (idVoyage INT AUTO_INCREMENT NOT NULL, intituleVoyage VARCHAR(32) NOT NULL COLLATE utf8_general_ci, prixVoyage INT NOT NULL, PRIMARY KEY(idVoyage)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (login VARCHAR(20) NOT NULL COLLATE utf8_general_ci, nom VARCHAR(20) NOT NULL COLLATE utf8_general_ci, prenom VARCHAR(20) NOT NULL COLLATE utf8_general_ci, PRIMARY KEY(login)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voiture (immatriculation VARCHAR(8) NOT NULL COLLATE utf8_general_ci, marque VARCHAR(25) NOT NULL COLLATE utf8_general_ci, couleur VARCHAR(12) NOT NULL COLLATE utf8_general_ci, PRIMARY KEY(immatriculation)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE trajet ADD CONSTRAINT FK_2B5BA98CF1B4A132 FOREIGN KEY (conducteur_login) REFERENCES utilisateur (login) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ttv_commandes ADD CONSTRAINT FK_DF2093EC5C8C21CF FOREIGN KEY (idVoyage) REFERENCES ttv_voyages (idVoyage) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE ttv_commandes ADD CONSTRAINT FK_DF2093ECA455ACCF FOREIGN KEY (idClient) REFERENCES ttv_clients (idClient) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voltaire_bareme');
        $this->addSql('DROP TABLE voltaire_critere');
        $this->addSql('DROP TABLE voltaire_enseignant');
        $this->addSql('DROP TABLE voltaire_etudiant');
        $this->addSql('DROP TABLE voltaire_modules');
        $this->addSql('DROP TABLE voltaire_niveau');
        $this->addSql('DROP TABLE voltaire_resultat_niveau');
        $this->addSql('DROP TABLE voltaire_resultats');
        $this->addSql('DROP TABLE voltaire_user');
    }
}
