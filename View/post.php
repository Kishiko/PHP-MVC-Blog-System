<?php
/**
 * @author           Pierre-Henry Soria <phy@hizup.uk>
 * @copyright        (c) 2015-2017, Pierre-Henry Soria. All Rights Reserved.
 * @license          Lesser General Public License <http://www.gnu.org/copyleft/lesser.html>
 * @link             http://hizup.uk
 */
?>
<?php require 'inc/header.php' ?>

<?php if (empty($this->oPost)): ?>
    <p class="error">The post can't be be found!</p>
<?php else: ?>

    <article>
        <time datetime="<?=$this->oPost->createdDate?>" pubdate="pubdate"></time>

        <h1><?=htmlspecialchars($this->oPost->title)?></h1>
        <p><?=nl2br(htmlspecialchars($this->oPost->body))?></p>
        <p class="left small italic">Posted on <?=$this->oPost->createdDate?></p>

        <?php
            $oPost = $this->oPost;
            require 'inc/control_buttons.php';
        ?>
    </article>

    <br>
    <aside>
        <h3>Comments</h3>

        <?php if (empty($this->oComments)): ?>
            <p class="error">This post has any comment. Be the first to comment!</p>
        <?php else: ?>
            
            <?php foreach ($this->oComments as $oComment): ?>
                <h6>On <?= $oComment->createdDate ?></h6>
                <h4><?= $oComment->authorName ?> <em>said:</em></h4>
                <p><?= $oComment->content ?></p>
                <hr class="clear" /><br />
            <?php endforeach ?>

        <?php endif ?>

        <h4>Add a new comment</h4>
        <form action="<?=ROOT_URL?>?p=comment&a=add" method="post">

            <input type="hidden" name="id_post" value="<?=$this->oPost->id?>" />

            <p><label for="author_name">Your name:</label><br />
                <input type="text" name="author_name" id="author_name" required="required" />
            </p>

            <p><label for="content">Content:</label><br />
                <textarea name="content" id="content" rows="5" cols="35" required="required"></textarea>
            </p>

            <p><input type="submit" name="add_comment" value="Post a comment" /></p>
        </form>
    </aside>

<?php endif ?>

<?php require 'inc/footer.php' ?>
