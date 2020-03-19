<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200319223905 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE assoiffeur_notification (assoiffeur_id INT NOT NULL, notification_id INT NOT NULL, INDEX IDX_23FA77AAF7F61F2D (assoiffeur_id), INDEX IDX_23FA77AAEF1A9D84 (notification_id), PRIMARY KEY(assoiffeur_id, notification_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assoiffeur_notification ADD CONSTRAINT FK_23FA77AAF7F61F2D FOREIGN KEY (assoiffeur_id) REFERENCES assoiffeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE assoiffeur_notification ADD CONSTRAINT FK_23FA77AAEF1A9D84 FOREIGN KEY (notification_id) REFERENCES notification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE assoiffeur ADD administrateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assoiffeur ADD CONSTRAINT FK_CE3BB29F7EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('CREATE INDEX IDX_CE3BB29F7EE5403C ON assoiffeur (administrateur_id)');
        $this->addSql('ALTER TABLE produit CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE satistique ADD assoiffeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE satistique ADD CONSTRAINT FK_7EB1CEBCF7F61F2D FOREIGN KEY (assoiffeur_id) REFERENCES assoiffeur (id)');
        $this->addSql('CREATE INDEX IDX_7EB1CEBCF7F61F2D ON satistique (assoiffeur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE assoiffeur_notification');
        $this->addSql('ALTER TABLE assoiffeur DROP FOREIGN KEY FK_CE3BB29F7EE5403C');
        $this->addSql('DROP INDEX IDX_CE3BB29F7EE5403C ON assoiffeur');
        $this->addSql('ALTER TABLE assoiffeur DROP administrateur_id');
        $this->addSql('ALTER TABLE produit CHANGE commande_id commande_id INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE satistique DROP FOREIGN KEY FK_7EB1CEBCF7F61F2D');
        $this->addSql('DROP INDEX IDX_7EB1CEBCF7F61F2D ON satistique');
        $this->addSql('ALTER TABLE satistique DROP assoiffeur_id');
    }
}
