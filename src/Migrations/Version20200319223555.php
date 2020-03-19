<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200319223555 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE produit_promotion (produit_id INT NOT NULL, promotion_id INT NOT NULL, INDEX IDX_458A233DF347EFB (produit_id), INDEX IDX_458A233D139DF194 (promotion_id), PRIMARY KEY(produit_id, promotion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_assoiffeur (produit_id INT NOT NULL, assoiffeur_id INT NOT NULL, INDEX IDX_67038B92F347EFB (produit_id), INDEX IDX_67038B92F7F61F2D (assoiffeur_id), PRIMARY KEY(produit_id, assoiffeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_promotion ADD CONSTRAINT FK_458A233DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_promotion ADD CONSTRAINT FK_458A233D139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_assoiffeur ADD CONSTRAINT FK_67038B92F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_assoiffeur ADD CONSTRAINT FK_67038B92F7F61F2D FOREIGN KEY (assoiffeur_id) REFERENCES assoiffeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD commande_id INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2782EA2E54 ON produit (commande_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE produit_promotion');
        $this->addSql('DROP TABLE produit_assoiffeur');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2782EA2E54');
        $this->addSql('DROP INDEX IDX_29A5EC2782EA2E54 ON produit');
        $this->addSql('ALTER TABLE produit DROP commande_id, CHANGE photo photo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
