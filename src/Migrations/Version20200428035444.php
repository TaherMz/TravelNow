<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200428035444 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE etape_circuit (id INT AUTO_INCREMENT NOT NULL, code_ville_etape_id INT NOT NULL, code_circuit_etape_id INT NOT NULL, duree_etape INT NOT NULL, ordre_etape INT NOT NULL, INDEX IDX_484C507DC3548F59 (code_ville_etape_id), INDEX IDX_484C507D71827C11 (code_circuit_etape_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etape_circuit ADD CONSTRAINT FK_484C507DC3548F59 FOREIGN KEY (code_ville_etape_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE etape_circuit ADD CONSTRAINT FK_484C507D71827C11 FOREIGN KEY (code_circuit_etape_id) REFERENCES circuit (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE etape_circuit');
    }
}
