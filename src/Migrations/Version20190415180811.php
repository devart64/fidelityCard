<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190415180811 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client MODIFY idclient INT NOT NULL');
        $this->addSql('ALTER TABLE client DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE client ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD telephone VARCHAR(255) NOT NULL, ADD rue VARCHAR(255) NOT NULL, ADD codepostall VARCHAR(255) NOT NULL, ADD ville VARCHAR(255) NOT NULL, CHANGE idclient id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE client ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE client DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE client DROP nom, DROP prenom, DROP email, DROP telephone, DROP rue, DROP codepostall, DROP ville, CHANGE id idclient INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE client ADD PRIMARY KEY (idclient)');
    }
}
