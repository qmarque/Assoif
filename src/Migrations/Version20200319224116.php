<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200319224116 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assoiffe ADD cartebleue_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assoiffe ADD CONSTRAINT FK_363C7CE46289B15C FOREIGN KEY (cartebleue_id) REFERENCES carte_bleue (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_363C7CE46289B15C ON assoiffe (cartebleue_id)');
        $this->addSql('ALTER TABLE assoiffeur CHANGE administrateur_id administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD assoiffe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D644FF707 FOREIGN KEY (assoiffe_id) REFERENCES assoiffe (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D644FF707 ON commande (assoiffe_id)');
        $this->addSql('ALTER TABLE notification ADD assoiffe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA644FF707 FOREIGN KEY (assoiffe_id) REFERENCES assoiffe (id)');
        $this->addSql('CREATE INDEX IDX_BF5476CA644FF707 ON notification (assoiffe_id)');
        $this->addSql('ALTER TABLE produit CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE satistique CHANGE assoiffeur_id assoiffeur_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assoiffe DROP FOREIGN KEY FK_363C7CE46289B15C');
        $this->addSql('DROP INDEX UNIQ_363C7CE46289B15C ON assoiffe');
        $this->addSql('ALTER TABLE assoiffe DROP cartebleue_id');
        $this->addSql('ALTER TABLE assoiffeur CHANGE administrateur_id administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D644FF707');
        $this->addSql('DROP INDEX IDX_6EEAA67D644FF707 ON commande');
        $this->addSql('ALTER TABLE commande DROP assoiffe_id');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA644FF707');
        $this->addSql('DROP INDEX IDX_BF5476CA644FF707 ON notification');
        $this->addSql('ALTER TABLE notification DROP assoiffe_id');
        $this->addSql('ALTER TABLE produit CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE satistique CHANGE assoiffeur_id assoiffeur_id INT DEFAULT NULL');
    }
}
