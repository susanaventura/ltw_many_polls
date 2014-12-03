
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
				<form role="form" method="post">
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
					<?if($userAnsweredPoll == false){?>
					<button type="submit" name="vote" class="btn btn-default" >Vote</button>
					<?} if($userAnsweredPoll){?>
					<button type="btn" name="vote" class="btn btn-default" onClick="showResults(); return false;">See results</button>
					<?}?>
					<hr>
					<?php include('socialShares.php') ?>
				</form>
            </div>
			<?}?>
			<div class="col-md-12">
				<h3>Results</h3>
				<?php 
				if($userAnsweredPoll){?>
					<div id="wrapperResults">
						<? foreach( $poll->questions as $question) {			
							$results = getResults($question['id']);
							//var_dump($results); ?>
							<div class="col-lg-4 col-sm-6 text-center">
								<div id="chart_div<?=$question['id']?>" class="chart_div">
								<div id="chart-question<?=$question['id']?>" value=<?=$results['questionText']?>><?=$results['questionText']?></div>
								<?foreach($results['answers'] as $id => $answer) {?>
								<div id="chart-answerText<?=$id?>" value=<?=$answer['text']?>><?=$answer['text']?></div>
								<div id="chart-answerValue<?=$id?>" value=<?=$answer['n']?>><?=$answer['n']?></div>
								<?}?>
								</div>
							</div>
						<?} ?>
					</div>
				<? } ?>
				</div>
			</div>
			
        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Related Polls</h3>
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

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

        </div>
        <!-- /.row -->

