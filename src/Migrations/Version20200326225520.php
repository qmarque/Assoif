<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200326225520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assoiffeur DROP FOREIGN KEY FK_CE3BB29F33BC25D3');
        $this->addSql('CREATE TABLE assoiffeur_notification (assoiffeur_id INT NOT NULL, notification_id INT NOT NULL, INDEX IDX_23FA77AAF7F61F2D (assoiffeur_id), INDEX IDX_23FA77AAEF1A9D84 (notification_id), PRIMARY KEY(assoiffeur_id, notification_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_bleue (id INT AUTO_INCREMENT NOT NULL, nom_titulaire VARCHAR(255) NOT NULL, numero INT NOT NULL, date_expiration DATE NOT NULL, cryptogramme INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, typeproduit_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prix INT NOT NULL, dosage VARCHAR(255) NOT NULL, stock INT NOT NULL, photo VARCHAR(255) DEFAULT NULL, INDEX IDX_29A5EC2782EA2E54 (commande_id), INDEX IDX_29A5EC27F66E9EF6 (typeproduit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_promotion (produit_id INT NOT NULL, promotion_id INT NOT NULL, INDEX IDX_458A233DF347EFB (produit_id), INDEX IDX_458A233D139DF194 (promotion_id), PRIMARY KEY(produit_id, promotion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_assoiffeur (produit_id INT NOT NULL, assoiffeur_id INT NOT NULL, INDEX IDX_67038B92F347EFB (produit_id), INDEX IDX_67038B92F7F61F2D (assoiffeur_id), PRIMARY KEY(produit_id, assoiffeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assoiffeur_notification ADD CONSTRAINT FK_23FA77AAF7F61F2D FOREIGN KEY (assoiffeur_id) REFERENCES assoiffeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE assoiffeur_notification ADD CONSTRAINT FK_23FA77AAEF1A9D84 FOREIGN KEY (notification_id) REFERENCES notification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27F66E9EF6 FOREIGN KEY (typeproduit_id) REFERENCES type_produit (id)');
        $this->addSql('ALTER TABLE produit_promotion ADD CONSTRAINT FK_458A233DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_promotion ADD CONSTRAINT FK_458A233D139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_assoiffeur ADD CONSTRAINT FK_67038B92F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_assoiffeur ADD CONSTRAINT FK_67038B92F7F61F2D FOREIGN KEY (assoiffeur_id) REFERENCES assoiffeur (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE assoiffeur_promotion');
        $this->addSql('DROP TABLE statistiques');
        $this->addSql('ALTER TABLE administrateur ADD mdp VARCHAR(255) NOT NULL, CHANGE mot_de_passe email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE assoiffe ADD cartebleue_id INT DEFAULT NULL, ADD email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE assoiffe ADD CONSTRAINT FK_363C7CE46289B15C FOREIGN KEY (cartebleue_id) REFERENCES carte_bleue (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_363C7CE46289B15C ON assoiffe (cartebleue_id)');
        $this->addSql('DROP INDEX IDX_CE3BB29F33BC25D3 ON assoiffeur');
        $this->addSql('ALTER TABLE assoiffeur ADD email VARCHAR(255) NOT NULL, ADD mdp VARCHAR(255) NOT NULL, ADD mdp_provisoire VARCHAR(255) NOT NULL, ADD bd VARCHAR(255) NOT NULL, DROP statistiques_id, DROP mot_de_passe, DROP mot_de_passe_provisoire, DROP base_donnee, CHANGE administrateur_id administrateur_id INT DEFAULT NULL, CHANGE logo logo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commande ADD nb_produit_par_type INT NOT NULL, ADD nb_produit_total INT NOT NULL, DROP nb_produits_par_type, DROP nb_produits_total');
        $this->addSql('ALTER TABLE notification DROP id_assoiffe, DROP id_assoiffeur');
        $this->addSql('ALTER TABLE promotion DROP produits_concernes');
        $this->addSql('ALTER TABLE satistique ADD assoiffeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE satistique ADD CONSTRAINT FK_7EB1CEBCF7F61F2D FOREIGN KEY (assoiffeur_id) REFERENCES assoiffeur (id)');
        $this->addSql('CREATE INDEX IDX_7EB1CEBCF7F61F2D ON satistique (assoiffeur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assoiffe DROP FOREIGN KEY FK_363C7CE46289B15C');
        $this->addSql('ALTER TABLE produit_promotion DROP FOREIGN KEY FK_458A233DF347EFB');
        $this->addSql('ALTER TABLE produit_assoiffeur DROP FOREIGN KEY FK_67038B92F347EFB');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27F66E9EF6');
        $this->addSql('CREATE TABLE assoiffeur_promotion (assoiffeur_id INT NOT NULL, promotion_id INT NOT NULL, INDEX IDX_9E364C4E139DF194 (promotion_id), INDEX IDX_9E364C4EF7F61F2D (assoiffeur_id), PRIMARY KEY(assoiffeur_id, promotion_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE statistiques (id INT AUTO_INCREMENT NOT NULL, chiffre_affaire INT NOT NULL, nb_commande_par_jour INT NOT NULL, nb_verres_par_personne INT NOT NULL, meilleure_vente VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, horaires_pointe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE assoiffeur_promotion ADD CONSTRAINT FK_9E364C4E139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE assoiffeur_promotion ADD CONSTRAINT FK_9E364C4EF7F61F2D FOREIGN KEY (assoiffeur_id) REFERENCES assoiffeur (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE assoiffeur_notification');
        $this->addSql('DROP TABLE carte_bleue');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_promotion');
        $this->addSql('DROP TABLE produit_assoiffeur');
        $this->addSql('DROP TABLE type_produit');
        $this->addSql('ALTER TABLE administrateur ADD mot_de_passe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP email, DROP mdp');
        $this->addSql('DROP INDEX UNIQ_363C7CE46289B15C ON assoiffe');
        $this->addSql('ALTER TABLE assoiffe DROP cartebleue_id, DROP email');
        $this->addSql('ALTER TABLE assoiffeur ADD statistiques_id INT NOT NULL, ADD mot_de_passe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD mot_de_passe_provisoire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD base_donnee VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP email, DROP mdp, DROP mdp_provisoire, DROP bd, CHANGE administrateur_id administrateur_id INT NOT NULL, CHANGE logo logo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE assoiffeur ADD CONSTRAINT FK_CE3BB29F33BC25D3 FOREIGN KEY (statistiques_id) REFERENCES statistiques (id)');
        $this->addSql('CREATE INDEX IDX_CE3BB29F33BC25D3 ON assoiffeur (statistiques_id)');
        $this->addSql('ALTER TABLE commande ADD nb_produits_par_type INT NOT NULL, ADD nb_produits_total INT NOT NULL, DROP nb_produit_par_type, DROP nb_produit_total');
        $this->addSql('ALTER TABLE notification ADD id_assoiffe INT NOT NULL, ADD id_assoiffeur INT NOT NULL');
        $this->addSql('ALTER TABLE promotion ADD produits_concernes VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE satistique DROP FOREIGN KEY FK_7EB1CEBCF7F61F2D');
        $this->addSql('DROP INDEX IDX_7EB1CEBCF7F61F2D ON satistique');
        $this->addSql('ALTER TABLE satistique DROP assoiffeur_id');
    }
}
