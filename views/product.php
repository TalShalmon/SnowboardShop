<?php
	if (!defined('snowboards'))
		header('Location: /');
?>

<h1>מוצר - <?php echo $this->product["name"]; ?></h1>

<?php
	echo '<div id="product-info">' . "\n";
	echo '<div class="info-title">' . "\n";
	echo '<div>מחיר:</div>';
	echo '<div>היצרן:</div>';
	echo '<div>מגדר:</div>';
	echo '<div>רמת קושי:</div>';
	echo '<div>סוג פרופיל:</div>';
	echo '<div>גודל:</div>';
	echo '<div>רוחב:</div>';
	echo '</div>' . "\n";
	echo '<div class="info">' . "\n";
	echo '<div id="price">₪' . $this->product["price"] . '</div>';
	echo '<div id="manufacture">' . $this->product["manufacture"] . '</div>';
	echo '<div id="gender">' . $this->product["gender"] . '</div>';
	echo '<div id="ability_level">' . $this->product["ability_level"] . '</div>';
	echo '<div id="profile_type">' . $this->product["profile_type"] . '</div>';
	echo '<div id="size">' . $this->product["size"] . ' ס"מ</div>';
	echo '<div id="width">' . $this->product["min_width"] . '-' . $this->product["max_width"] . ' ס"מ</div>';
	echo '</div>' . "\n";
	
	if ($this->product["pic"] == 'true') {
		echo '<div id="img"><img src="' . URL . 'public/images/' . $this->product["name"] . '.png" /></div>' . "\n";
	} else {
		echo '<div id="img"><img src="' . URL . 'public/images/NoPic.png" /></div>' . "\n";
	}
	echo '</div>' . "\n";
	echo '<input type="submit" id="add_to_cart" value="הוספת לעגלת קניות" onclick="addToCart()" />' . "\n";
	
	if (Session::get('loggedIn') == true) {
		echo '<input type="submit" id="add_review" value="הוספת סקירה" onclick="addReviewWindow(' .
							$this->product["id"] . ', ' . Session::get('id') . ')" />' . "\n";
		echo '<div id="review"></div>' . "\n";
	}
	
	echo '<div id="reviews">' . "\n";
	foreach ($this->reviews as $value) {
		echo '<div id="review_' . $value['id'] . '">' . "\n";
		echo '<div class="review_title">' . "\n";
		if (Session::get('loggedIn') == true) {
			foreach ($this->usersName as $user) {
				if ($user['id'] == $value['reviewed_by']) {
					$name = $user['first_name'] . ' ' . $user['sur_name'];
				}
			}
			
			echo '<div class="review-info">שם: ' . $name . '</div>';
		}
		
		$date = date_format(date_create($value['reviewed_date']), 'd/m/Y H:i');
		echo '<div class="review-info">תאריך: ' . $date . '</div>';
		
		if ($value['grade']) {
			echo '<div class="grades">ציון: ' . $value['grade'] . '</div>';
		}
		
		echo '</div>' . "\n";
		echo '<div class=review_body id=review' . $value['id'] . '>' . $value['text'] . '</div>' . "\n";
		echo '</div>' . "\n";
	}
	echo '</div>' . "\n";
?>
