<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331145618 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE renting_detail_piece (renting_detail_id INT NOT NULL, piece_id INT NOT NULL, INDEX IDX_78F78DAD21DDB89B (renting_detail_id), INDEX IDX_78F78DADC40FCFA8 (piece_id), PRIMARY KEY(renting_detail_id, piece_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE renting_detail_piece ADD CONSTRAINT FK_78F78DAD21DDB89B FOREIGN KEY (renting_detail_id) REFERENCES renting_detail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE renting_detail_piece ADD CONSTRAINT FK_78F78DADC40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE renting_detail ADD renting_id INT NOT NULL');
        $this->addSql('ALTER TABLE renting_detail ADD CONSTRAINT FK_6FDA6245EC8CFBAF FOREIGN KEY (renting_id) REFERENCES renting (id)');
        $this->addSql('CREATE INDEX IDX_6FDA6245EC8CFBAF ON renting_detail (renting_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE renting_detail_piece');
        $this->addSql('ALTER TABLE renting_detail DROP FOREIGN KEY FK_6FDA6245EC8CFBAF');
        $this->addSql('DROP INDEX IDX_6FDA6245EC8CFBAF ON renting_detail');
        $this->addSql('ALTER TABLE renting_detail DROP renting_id');
    }
}
