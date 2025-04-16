<?php
require 'config.php';
//include("session.php");
?>
<ul class="contacts-list">
				
				<?php
				 if(isset($_POST['input']))
				 {
					 $input2=$_POST['input'];
					 $input=strtolower($input2);
					 if ($input=="none")
					 {

										$query = "SELECT * FROM faculty";
										$query_run = mysqli_query($db, $query);
					 }
					 else if($input=="")

					{
										$query ="SELECT * FROM faculty";
										$query_run = mysqli_query($db, $query);
						 
					}
					
					else
					{
						//$input="";
									if ($input=="aids")
										{
											$input="Artificial Intelligence and Data Science";
										}
									else if($input=="aiml")
										{
											$input="Artificial Intelligence and Machine Learning";
										}
									else if($input=="civil")
										{
											$input="Civil Engineering";
										}
									else if($input=="csbs")
										{
											$input="Computer Science and Business Systems";
										}
									else if($input=="cse")
										{
											$input="Computer Science and Engineering";
										}
									else if($input=="eee")
										{
											$input="Electrical and Electronics Engineering";
										}
									else if($input=="ece")
										{
											$input="Electronics and Communication Engineering";
										}
									else if($input=="it")
										{
											$input="Information Technology";
										}
									else if($input=="mech")
										{
											$input="Mechanical Engineering";
										}
									else if($input=="mba")
										{
											$input="Master of Business Administration";
										}
									else if($input=="mca")
										{
											$input="Master of Computer Applications";
										}
									else if($input=="fe")
										{
											$input="Freshman Engineering";
										}
						
						$query = "SELECT * FROM faculty WHERE name LIKE '{$input}%' or dept LIKE '{$input}%'";
						$query_run = mysqli_query($db, $query);
					}
					
					
										if(mysqli_num_rows($query_run) > 0)
										{
											foreach($query_run as $student)
											{
												$s=$student['id'];
												if($student['dept']!="")
												{
                                    ?>

					<div class="contact-section">
						<li class="list__item">
							<p class="contact-name"><b><?= $student['name']?></b></p>
							<?php
										$d=$student['dept'];
										if ($d=="Artificial Intelligence and Data Science")
										{
											$dept="AI&DS";
										}
										else if($d=="Artificial Intelligence and Machine Learning")
										{
											$dept="AI&ML";
										}
										else if($d=="Civil Engineering")
										{
											$dept="CIVIL";
										}
										else if($d=="Computer Science and Business Systems")
										{
											$dept="CSBS";
										}
										else if($d=="Computer Science and Engineering")
										{
											$dept="CSE";
										}
										else if($d=="Electrical and Electronics Engineering")
										{
											$dept="EEE";
										}
										else if($d=="Electronics and Communication Engineering")
										{
											$dept="ECE";
										}
										else if($d=="Information Technology")
										{
											$dept="IT";
										}
										else if($d=="Mechanical Engineering")
										{
											$dept="MECH";
										}
										else if($d=="Master of Business Administration")
										{
											$dept="MBA";
										}
										else if($d=="Master of Computer Applications")
										{
											$dept="MCA";
										}
										else if($d=="Freshman Engineering")
										{
											$dept="FE";
										}

							?>
							<p class="relationship"><?= $dept?></p>
						</li>
						<?php
						$query = "SELECT mobile,email FROM basic WHERE id='$s'";
						$query_run = mysqli_query($db, $query);
						if(mysqli_num_rows($query_run) > 0){
						$row = mysqli_fetch_assoc($query_run);
						$m=$row['mobile'];	
						$e=$row['email'];
						}
						?>			
								
						<li class="list__item">
							<a href="tel:<?php echo $m;?>">	<i class="fas fa-phone"></i></a>
							<p></p>
							<a href="mailto:<?php echo $e;?>"><i class="fas fa-envelope"></i></a>
							<p></p>
							<a href="https://wa.me/<?php echo $m;?>"><i class="fa fa-whatsapp"></i></a>
						</li>
										
					</div>
					<hr>
				<?php
											}
											}
												
                            }
				 }
                            ?>
			</ul>