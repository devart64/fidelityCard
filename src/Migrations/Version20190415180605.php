<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190415180605 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client MODIFY idClient INT NOT NULL');
        $this->addSql('ALTER TABLE client DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE client ADD codepostall VARCHAR(255) NOT NULL, DROP codepostal, CHANGE telephone telephone VARCHAR(255) NOT NULL, CHANGE idclient id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE client ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE client DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE client ADD codepostal VARCHAR(5) NOT NULL COLLATE utf8_general_ci, DROP codepostall, CHANGE telephone telephone VARCHAR(10) NOT NULL COLLATE utf8_general_ci, CHANGE id idClient INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE client ADD PRIMARY KEY (idClient)');
    }
}
