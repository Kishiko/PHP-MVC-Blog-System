<?php
/**
 * @author           Serge Kishiko <sergekishiko@gmail.com>
 * @copyright        (c) 2015-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license          Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
 * @link             http://hizup.uk
 */

namespace TestProject\Controller;

class Comment extends Blog
{
    public function __construct()
    {
        $this->oUtil = new \TestProject\Engine\Util;
        
        /** Get the Model class in all the controller class **/
        $this->oUtil->getModel('Comment');
        $this->oCommentModel = new \TestProject\Model\Comment;
    }

    public function add()
    {
        if (!empty($_POST['add_comment']))
        {
            if (isset($_POST['id_post'], $_POST['content'], $_POST['author_name']))
            {
                $aData = array(
                    'id_post' => $_POST['id_post'], 
                    'content' => $_POST['content'], 
                    'author_name' => $_POST['author_name'],
                    'created_date' => date('Y-m-d H:i:s')
                );

                if ($this->oCommentModel->add($aData))
                    header('Location:' . ROOT_URL . '?p=blog&a=post&id=' . $_POST['id_post']);
                else
                    $this->oUtil->sErrMsg = 'Whoops! An error has occurred! Please try again later.';
            }
            else
            {
                $this->oUtil->sErrMsg = 'All fields are required and the title cannot exceed 50 characters.';
            }
        }
    }
}
