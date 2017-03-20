<?php defined('_JEXEC') or die(); ?>
<?php if ($this->allow_review){?>
    <div class="review_header"><?php print _JSHOP_REVIEWS?></div>
    <?php foreach($this->reviews as $curr){?>
        <div class="review_item">
        <div><span class="review_user"><?php print $curr->user_name?></span>, <span class='review_time'><?php print formatdate($curr->time);?></span></div>
        <div class="review_text"><?php print nl2br($curr->review)?></div>
        <?php if ($curr->mark) {?>
            <div class="review_mark"><?php print showMarkStar($curr->mark);?></div>
        <?php } ?> 
        </div>
    <?php }?>
    <?php if ($this->display_pagination){?>
    <div class="jshop_pagination">
    	<div class="pagination"><?php print $this->pagination?></div></td>
	</div>
    <?php }?>
    <?php if ($this->allow_review > 0){?>
        <?php JHTML::_('behavior.formvalidation'); ?> 
        <span class="review"><?php print _JSHOP_ADD_REVIEW_PRODUCT?></span>
        <form action="<?php print SEFLink('index.php?option=com_jshopping&controller=product&task=reviewsave');?>" name="add_review" method="post" onsubmit="return validateReviewForm(this.name)">
        <input type="hidden" name="product_id" value="<?php print $this->product->product_id?>" />

        <input type="hidden" name="back_link" value="<?php print jsFilterUrl($_SERVER['REQUEST_URI'])?>" />
        <div id="jshop_review_write" >
            <div class="control-group">
				<div class="control-label">
					<label><?php print _JSHOP_REVIEW_USER_NAME?></label>
            	</div>
				<div class="controls">
                    <input type="text" name="user_name" id="review_user_name" class="inputbox" value="<?php print $this->user->username?>"/>
             	</div>
            </div>
            <div class="control-group">
				<div class="control-label">
					<label><?php print _JSHOP_REVIEW_USER_EMAIL?></label>
                </div>
				<div class="controls">
                    <input type="text" name="user_email" id="review_user_email" class="inputbox" value="<?php print $this->user->email?>" />
                </div>
            </div>
            <div class="control-group">
				<div class="control-label">
					<label><?php print _JSHOP_REVIEW_REVIEW?></label>
                </div>
				<div class="controls">
                    <textarea name="review" id="review_review" rows="4" cols="40" class="jshop inputbox" style="width:320px;"></textarea>
                </div>
            </div>
            <div class="control-group">
				<div class="control-label">
					<label><?php print _JSHOP_REVIEW_MARK_PRODUCT?></label>
                </div>
                <?php //echo $this->stars_count; die(); 2
					//echo $this->parts_count; die(); 10
					// config : Comment maximal mark 10
				?>
				<div class="controls">
                    <?php for($i=1; $i<= $this->stars_count*$this->parts_count; $i++){?>
                        <input name="mark" type="radio" class="star {split:<?php print $this->parts_count?>} <?php if ($i%2 == 0 && $this->parts_count ==2){ echo ' even';}?>" value="<?php print $i?>" <?php if ($i==$this->stars_count*$this->parts_count){?>checked="checked"<?php }?>/>
                    <?php } ?>
                </div>
            </div>
            <?php print $this->_tmp_product_review_before_submit;?>
            <div class="control-group">
                    <input type="submit" class="button validate" value="<?php print _JSHOP_REVIEW_SUBMIT?>" />
            </div>
        </div>
        </form>
    <?php }else{?>
        <div class="review_text_not_login"><?php print $this->text_review?></div>
    <?php } ?>
<?php }?>