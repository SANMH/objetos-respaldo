<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191209045515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE oferta (id INT AUTO_INCREMENT NOT NULL, subasta_id INT NOT NULL, user_id INT NOT NULL, cuanto DOUBLE PRECISION NOT NULL, INDEX IDX_7479C8F260B185C4 (subasta_id), INDEX IDX_7479C8F2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subasta (id INT AUTO_INCREMENT NOT NULL, objetos_id INT NOT NULL, valor DOUBLE PRECISION NOT NULL, fecha_ingreso DATETIME NOT NULL, oferta DOUBLE PRECISION NOT NULL, nombre VARCHAR(255) NOT NULL, estado VARCHAR(255) NOT NULL, INDEX IDX_5C3A06C4420DFD83 (objetos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F260B185C4 FOREIGN KEY (subasta_id) REFERENCES subasta (id)');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F2A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE subasta ADD CONSTRAINT FK_5C3A06C4420DFD83 FOREIGN KEY (objetos_id) REFERENCES objetos (id)');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) DEFAULT NULL, CHANGE last_login last_login DATETIME DEFAULT NULL, CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL, CHANGE password_requested_at password_requested_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oferta DROP FOREIGN KEY FK_7479C8F260B185C4');
        $this->addSql('DROP TABLE oferta');
        $this->addSql('DROP TABLE subasta');
        $this->addSql('ALTER TABLE fos_user CHANGE salt salt VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE last_login last_login DATETIME DEFAULT \'NULL\', CHANGE confirmation_token confirmation_token VARCHAR(180) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE password_requested_at password_requested_at DATETIME DEFAULT \'NULL\'');
    }
}
