<?php

namespace CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180227150417 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, exchangeRate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE print_type ADD currency_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE print_type ADD CONSTRAINT FK_58D1156D38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_58D1156D38248176 ON print_type (currency_id)');
        $this->addSql('ALTER TABLE paper ADD currency_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paper ADD CONSTRAINT FK_4E1A601638248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_4E1A601638248176 ON paper (currency_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE print_type DROP FOREIGN KEY FK_58D1156D38248176');
        $this->addSql('ALTER TABLE paper DROP FOREIGN KEY FK_4E1A601638248176');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP INDEX IDX_4E1A601638248176 ON paper');
        $this->addSql('ALTER TABLE paper DROP currency_id');
        $this->addSql('DROP INDEX IDX_58D1156D38248176 ON print_type');
        $this->addSql('ALTER TABLE print_type DROP currency_id');
    }
}
