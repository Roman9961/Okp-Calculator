<?php

namespace CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180305164632 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE post_print_operation (id INT AUTO_INCREMENT NOT NULL, material_id INT DEFAULT NULL, currency_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, multiplier INT DEFAULT 1 NOT NULL COMMENT \'количество повторений на единицу продукции, напр. 2 скобы в буклете\', price DOUBLE PRECISION NOT NULL, INDEX IDX_26D14F1CE308AC6F (material_id), INDEX IDX_26D14F1C38248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_print_material (id INT AUTO_INCREMENT NOT NULL, currency_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_9951D93338248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_print_operation ADD CONSTRAINT FK_26D14F1CE308AC6F FOREIGN KEY (material_id) REFERENCES post_print_material (id)');
        $this->addSql('ALTER TABLE post_print_operation ADD CONSTRAINT FK_26D14F1C38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE post_print_material ADD CONSTRAINT FK_9951D93338248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_print_operation DROP FOREIGN KEY FK_26D14F1CE308AC6F');
        $this->addSql('DROP TABLE post_print_operation');
        $this->addSql('DROP TABLE post_print_material');
    }
}
