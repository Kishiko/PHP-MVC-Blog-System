<?php
/**
 * @author           Serge Kishiko <sergekishiko@gmail.com>
 * @copyright        (c) 2015-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license          Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
 * @link             http://hizup.uk
 */

namespace TestProject\Model;

class Comment
{
    protected $oDb;

    public function __construct()
    {
        $this->oDb = new \TestProject\Engine\Db;
    }

    public function add(array $aData)
    {
        $oStmt = $this->oDb->prepare('INSERT INTO Comments (idPost, content, authorName, createdDate) VALUES(:id_post, :content, :author_name, :created_date)');
        return $oStmt->execute($aData);
    }

    public function getPostComments($iPostId)
    {
        $oStmt = $this->oDb->prepare('SELECT * FROM Comments WHERE idPost = :postId');
        $oStmt->bindParam(':postId', $iPostId, \PDO::PARAM_INT);
        $oStmt->execute();
        return $oStmt->fetchAll(\PDO::FETCH_OBJ);
    }
}
