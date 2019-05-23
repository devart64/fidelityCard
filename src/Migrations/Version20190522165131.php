<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190522165131 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image_tampon (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user DROP idCarteFidelite');
        $this->addSql('DROP INDEX nom ON client');
        $this->addSql('DROP INDEX email ON client');
        $this->addSql('DROP INDEX prenom ON client');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE image_tampon');
        $this->addSql('CREATE INDEX nom ON client (nom)');
        $this->addSql('CREATE UNIQUE INDEX email ON client (email)');
        $this->addSql('CREATE INDEX prenom ON client (prenom)');
        $this->addSql('ALTER TABLE user ADD idCarteFidelite INT NOT NULL');
    }
}
