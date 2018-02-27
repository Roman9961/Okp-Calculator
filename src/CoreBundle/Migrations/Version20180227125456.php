<?php

namespace CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180227125456 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE print_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE print (id INT AUTO_INCREMENT NOT NULL, side_a_id INT NOT NULL, side_b_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_15D67C66679A726F (side_a_id), INDEX IDX_15D67C66752FDD81 (side_b_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE print ADD CONSTRAINT FK_15D67C66679A726F FOREIGN KEY (side_a_id) REFERENCES print_type (id)');
        $this->addSql('ALTER TABLE print ADD CONSTRAINT FK_15D67C66752FDD81 FOREIGN KEY (side_b_id) REFERENCES print_type (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE print DROP FOREIGN KEY FK_15D67C66679A726F');
        $this->addSql('ALTER TABLE print DROP FOREIGN KEY FK_15D67C66752FDD81');
        $this->addSql('DROP TABLE print_type');
        $this->addSql('DROP TABLE print');
    }
}
