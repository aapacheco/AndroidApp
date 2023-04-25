<?php
function randvalcheck($BarcodeValue)
{
	if ($stmt = $mysqli->prepare("SELECT BarcodeValue FROM users WHERE BarcodeValue=?")) 
	{
        	if ($stmt->bind_param("i", $BarcodeValue)) 
		{
          		if ($stmt->execute()) 
			{
				$result = $stmt->get_result();
            			if ($row = $result->fetch_assoc()) 
				{
					$BarcodeValue = (int) rand(48,10048);
					randvalcheck($BarcodeValue);
	   			}
			}
		}
	}
}
?>