<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200330203046 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE administrateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assoiffe (id INT AUTO_INCREMENT NOT NULL, cartebleue_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_363C7CE46289B15C (cartebleue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assoiffeur (id INT AUTO_INCREMENT NOT NULL, administrateur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, nom_gerant VARCHAR(255) NOT NULL, siege_social VARCHAR(255) NOT NULL, siret INT NOT NULL, siren INT NOT NULL, logo VARCHAR(255) NOT NULL, periode_fermeture VARCHAR(255) NOT NULL, INDEX IDX_CE3BB29F7EE5403C (administrateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assoiffeur_notification (assoiffeur_id INT NOT NULL, notification_id INT NOT NULL, INDEX IDX_23FA77AAF7F61F2D (assoiffeur_id), INDEX IDX_23FA77AAEF1A9D84 (notification_id), PRIMARY KEY(assoiffeur_id, notification_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_bleue (id INT AUTO_INCREMENT NOT NULL, nom_titulaire VARCHAR(255) NOT NULL, numero INT NOT NULL, date_expiration DATE NOT NULL, cryptogramme INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, assoiffe_id INT DEFAULT NULL, nb_produit_par_type INT NOT NULL, prix INT NOT NULL, nb_produit_total INT NOT NULL, INDEX IDX_6EEAA67D644FF707 (assoiffe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, assoiffe_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_BF5476CA644FF707 (assoiffe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, typeproduit_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prix INT NOT NULL, dosage VARCHAR(255) NOT NULL, stock INT NOT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_29A5EC2782EA2E54 (commande_id), INDEX IDX_29A5EC27F66E9EF6 (typeproduit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_promotion (produit_id INT NOT NULL, promotion_id INT NOT NULL, INDEX IDX_458A233DF347EFB (produit_id), INDEX IDX_458A233D139DF194 (promotion_id), PRIMARY KEY(produit_id, promotion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_assoiffeur (produit_id INT NOT NULL, assoiffeur_id INT NOT NULL, INDEX IDX_67038B92F347EFB (produit_id), INDEX IDX_67038B92F7F61F2D (assoiffeur_id), PRIMARY KEY(produit_id, assoiffeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, description VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE satistique (id INT AUTO_INCREMENT NOT NULL, assoiffeur_id INT DEFAULT NULL, chchiffre_affaire INT NOT NULL, nb_commande_par_jour INT NOT NULL, nb_verres_par_pers INT NOT NULL, meilleure_vente VARCHAR(255) NOT NULL, horaire_pointe VARCHAR(255) NOT NULL, INDEX IDX_7EB1CEBCF7F61F2D (assoiffeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assoiffe ADD CONSTRAINT FK_363C7CE46289B15C FOREIGN KEY (cartebleue_id) REFERENCES carte_bleue (id)');
        $this->addSql('ALTER TABLE assoiffeur ADD CONSTRAINT FK_CE3BB29F7EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('ALTER TABLE assoiffeur_notification ADD CONSTRAINT FK_23FA77AAF7F61F2D FOREIGN KEY (assoiffeur_id) REFERENCES assoiffeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE assoiffeur_notification ADD CONSTRAINT FK_23FA77AAEF1A9D84 FOREIGN KEY (notification_id) REFERENCES notification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D644FF707 FOREIGN KEY (assoiffe_id) REFERENCES assoiffe (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA644FF707 FOREIGN KEY (assoiffe_id) REFERENCES assoiffe (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27F66E9EF6 FOREIGN KEY (typeproduit_id) REFERENCES type_produit (id)');
        $this->addSql('ALTER TABLE produit_promotion ADD CONSTRAINT FK_458A233DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_promotion ADD CONSTRAINT FK_458A233D139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_assoiffeur ADD CONSTRAINT FK_67038B92F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_assoiffeur ADD CONSTRAINT FK_67038B92F7F61F2D FOREIGN KEY (assoiffeur_id) REFERENCES assoiffeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE satistique ADD CONSTRAINT FK_7EB1CEBCF7F61F2D FOREIGN KEY (assoiffeur_id) REFERENCES assoiffeur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assoiffeur DROP FOREIGN KEY FK_CE3BB29F7EE5403C');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D644FF707');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA644FF707');
        $this->addSql('ALTER TABLE assoiffeur_notification DROP FOREIGN KEY FK_23FA77AAF7F61F2D');
        $this->addSql('ALTER TABLE produit_assoiffeur DROP FOREIGN KEY FK_67038B92F7F61F2D');
        $this->addSql('ALTER TABLE satistique DROP FOREIGN KEY FK_7EB1CEBCF7F61F2D');
        $this->addSql('ALTER TABLE assoiffe DROP FOREIGN KEY FK_363C7CE46289B15C');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2782EA2E54');
        $this->addSql('ALTER TABLE assoiffeur_notification DROP FOREIGN KEY FK_23FA77AAEF1A9D84');
        $this->addSql('ALTER TABLE produit_promotion DROP FOREIGN KEY FK_458A233DF347EFB');
        $this->addSql('ALTER TABLE produit_assoiffeur DROP FOREIGN KEY FK_67038B92F347EFB');
        $this->addSql('ALTER TABLE produit_promotion DROP FOREIGN KEY FK_458A233D139DF194');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27F66E9EF6');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE assoiffe');
        $this->addSql('DROP TABLE assoiffeur');
        $this->addSql('DROP TABLE assoiffeur_notification');
        $this->addSql('DROP TABLE carte_bleue');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_promotion');
        $this->addSql('DROP TABLE produit_assoiffeur');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE satistique');
        $this->addSql('DROP TABLE type_produit');
    }
}
