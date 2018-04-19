<?php
$query_c = "SELECT * FROM sale, products, category WHERE sale.itemNo= products.productCode and products.productLine= category.cat_id and invoice_id='$invoice_id'";
$Details = mysqli_query($conn,$query_c) or die(mysqli_error($conn));
$row_Details = mysqli_fetch_assoc($Details);
$j=0;

?>

<table width="100%" border="1" cellpadding="2" cellspacing="2">
							  <thead>
								  <tr>
                                  	  <th width="8%">নং</th>
									  <th width="40%">পন্যের বিবরন</th>
									  <th width="21%">পরিমান</th>
									  <th width="21%">পরিমাপ</th>
                                      
								  </tr>
							  </thead>   
							  <tbody>

                              <?php do { ?>
								<tr>
                                    <td class="center"><?php $j++; echo convertbn($j); ?>.</td>
									<td class="center"><?php echo $row_Details['productName']; ?></td>
									
									<td class="center"><?php echo convertbn($row_Details['quantity']); ?>&nbsp; <?php echo $row_Details['cat_unit']; ?></td>
									<td class="center"><?php $qty=$row_Details['quantity'];
									$unit=$row_Details['perunit'];
									$porimap=($qty/$unit);
									echo convertbn($porimap); 
									
									?> পিস</td>
                                  
								</tr>
                                <?php } while ($row_Details = mysqli_fetch_assoc($Details)); ?>
                            
							  </tbody>
					  </table>