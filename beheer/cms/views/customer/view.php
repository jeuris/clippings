<h2>Viewing #<?php echo $customer->id; ?></h2>

<p>
	<strong>Company name:</strong>
	<?php echo $customer->company_name; ?></p>
<p>
	<strong>First name:</strong>
	<?php echo $customer->first_name; ?></p>
<p>
	<strong>Last name:</strong>
	<?php echo $customer->last_name; ?></p>
<p>
	<strong>Email:</strong>
	<?php echo $customer->email; ?></p>
<p>
	<strong>Phone:</strong>
	<?php echo $customer->phone; ?></p>
<p>
	<strong>Street:</strong>
	<?php echo $customer->street; ?></p>
<p>
	<strong>Street number:</strong>
	<?php echo $customer->street_number; ?></p>
<p>
	<strong>Zip:</strong>
	<?php echo $customer->zip; ?></p>
<p>
	<strong>City:</strong>
	<?php echo $customer->city; ?></p>
<p>
	<strong>Country:</strong>
	<?php echo $customer->country; ?></p>

<?php echo Html::anchor('customer/edit/'.$customer->id, 'Edit'); ?> |
<?php echo Html::anchor('customer', 'Back'); ?>