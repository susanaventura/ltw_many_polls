
    <!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12 header-custom">
                <h1 class="page-header"><?=$poll->title?>
                    <small><?=$poll->owner?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">
            <div class="col-md-6" style="padding-top:25px;">
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
						<button id="voteButton" type="submit" name="vote" class="btn btn-default" ><?=$poll->voteLabel;?></button>
						<?}?>
						<button type="btn" id="resultsBtn" class="btn btn-default <? if($userAnsweredPoll == false) echo ' hidden'?>" onClick="showResults('<?=$question['id']?>'); return false;"><?=$poll->resultsLabel;?></button>
					</div>
				</form>
				<hr>
				<div id="shareBtns" class="row">
					<?php include('socialShares.php') ?>
				</div>
            </div>
			<?}?>

			<div id="resultsDiv" class="col-lg-12">
				<h3 class="page-header well bs-component">Results</h3>		
				<div id="wrapperResults">
					<div id="chart_div" style="width:100%; height:400 display: block; margin: 0 auto;"></div>
				</div>
			</div>

			
		</div>

        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="col-lg-12">
               <h3 class="page-header well bs-component">Related Polls</h3>
				<div><?php include("list_polls.php"); ?>
        </div>
        <!-- /.row -->
	

