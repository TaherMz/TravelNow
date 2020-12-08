<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200624172841 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etape_circuit DROP FOREIGN KEY FK_484C507D71827C11');
        $this->addSql('ALTER TABLE etape_circuit DROP FOREIGN KEY FK_484C507DC3548F59');
        $this->addSql('ALTER TABLE etape_circuit ADD CONSTRAINT FK_484C507D71827C11 FOREIGN KEY (code_circuit_etape_id) REFERENCES circuit (id)');
        $this->addSql('ALTER TABLE etape_circuit ADD CONSTRAINT FK_484C507DC3548F59 FOREIGN KEY (code_ville_etape_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C34124DC0B');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C34124DC0B FOREIGN KEY (code_dest_id) REFERENCES destination (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE admin');
        $this->addSql('ALTER TABLE etape_circuit DROP FOREIGN KEY FK_484C507DC3548F59');
        $this->addSql('ALTER TABLE etape_circuit DROP FOREIGN KEY FK_484C507D71827C11');
        $this->addSql('ALTER TABLE etape_circuit ADD CONSTRAINT FK_484C507DC3548F59 FOREIGN KEY (code_ville_etape_id) REFERENCES ville (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etape_circuit ADD CONSTRAINT FK_484C507D71827C11 FOREIGN KEY (code_circuit_etape_id) REFERENCES circuit (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C34124DC0B');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C34124DC0B FOREIGN KEY (code_dest_id) REFERENCES destination (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
