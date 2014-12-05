
    <!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?=$poll->title?>
                    <small><?=$poll->owner?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-6">
               <!-- <img class="img-responsive" src="http://placehold.it/750x500" alt="">-->
					<img id="pollImage" class="img-responsive" src=<?=$poll->image?> alt="">
            </div>
			<? foreach( $poll->questions as $question) {?>
            <div class="col-md-6">
				<form role="form" method="post" onsubmit="validateSubmitVote('<?=$user?>', '<?=$token?>','<?=$poll->id?>', '<?=$question['id']?>') ; return false;">
					<div class="form-group">
						<h3>Question</h3>
						<p><?=$question['question']?></p>
					</div>
					<div class="form-group">
						<h3>Choices</h3>
						<? foreach( $question['possibleanswers'] as $answer) {
							$chosen = $userAnsweredPoll && in_array($answer['id'], $userAnsweredPoll);
						?>
						<div class="wrapperChoice<?if($chosen) echo ' withBorder'?>">
							<? if($question['multipleAnswers']) { ?>
							<input type="checkbox" id="choice<?=$answer['id']?>" class="choice" name="choice" value=<?=$answer['id']?> <?if($chosen) echo 'checked'?> <?if($userAnsweredPoll) echo ' disabled'?>> 					
							<? }else{ ?>
							<input type="radio" id="choice<?=$answer['id']?>" class="choice" name="choice" value=<?=$answer['id']?> <?if($chosen) echo 'checked'?> <?if($userAnsweredPoll) echo  ' disabled'?>>
							<?}?>
							
							<label class="checkboxLabelNormal" for="choice<?=$answer['id']?>"><?=$answer['answer']?></label>
						</div>
						<?}?>	
					</div>
					<div class="form-group has-error">
						<label id="errorMsg" class="control-label"></label>
					</div>
					<div id="buttons">
						<?if($userAnsweredPoll == false){?>
						<button id="voteButton" type="submit" name="vote" class="btn btn-default" ><?=$poll->voteLabel;?></button><?}?>
						<button type="btn" id="resultsBtn" class="btn btn-default <? if($userAnsweredPoll == false) echo ' hidden'?>" onClick="showResults('<?=$question['id']?>'); return false;"><?=$poll->resultsLabel;?></button>
					</div>
					<hr>
				</form>
				<div id="shareBtns">
						<?php include('socialShares.php') ?>
					</div>
            </div>
			<?}?>
			<div class="col-lg-12">
				<h3 class="page-header">Results</h3>		
					<div id="wrapperResults">
						<div id="chart_div"></div>
					</div>
				</div>
			</div>
			
        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Related Polls</h3>

				<div class="col-sm-3 col-xs-6">
					<a href="#">
						<img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
					</a>
				</div>

				<div class="col-sm-3 col-xs-6">
					<a href="#">
						<img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
					</a>
				</div>

				<div class="col-sm-3 col-xs-6">
					<a href="#">
						<img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
					</a>
				</div>

				<div class="col-sm-3 col-xs-6">
					<a href="#">
						<img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
					</a>
				</div>
            </div>
        </div>
        <!-- /.row -->
	</div>
