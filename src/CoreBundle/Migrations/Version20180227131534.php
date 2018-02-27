<?php

namespace CoreBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180227131534 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, postPrint VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_paper (product_id INT NOT NULL, paper_id INT NOT NULL, INDEX IDX_EF461B4A4584665A (product_id), INDEX IDX_EF461B4AE6758861 (paper_id), PRIMARY KEY(product_id, paper_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_printing (product_id INT NOT NULL, printing_id INT NOT NULL, INDEX IDX_FB3F07644584665A (product_id), INDEX IDX_FB3F07647C9783D2 (printing_id), PRIMARY KEY(product_id, printing_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_paper ADD CONSTRAINT FK_EF461B4A4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_paper ADD CONSTRAINT FK_EF461B4AE6758861 FOREIGN KEY (paper_id) REFERENCES paper (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_printing ADD CONSTRAINT FK_FB3F07644584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_printing ADD CONSTRAINT FK_FB3F07647C9783D2 FOREIGN KEY (printing_id) REFERENCES print (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_paper DROP FOREIGN KEY FK_EF461B4A4584665A');
        $this->addSql('ALTER TABLE product_printing DROP FOREIGN KEY FK_FB3F07644584665A');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_paper');
        $this->addSql('DROP TABLE product_printing');
    }
}
