<?php
function ShowError($errors,$name)
{
   if($errors->has($name))
   {
       echo '<div class="alert alert-danger" role="alert">
                    <strong>'.$errors->first($name).'</strong>
            </div>';
   }
}

function GetCategory($mang,$parent,$shift,$select)
{
	
foreach($mang as $value)
{
   if($value['parent']==$parent)
   {
	  if($value['id']==$select)
			{
			echo "<option selected value=".$value['id'].">".$shift.$value['name']."</option>";

			}
		else
			{
 			echo "<option value=".$value['id'].">".$shift.$value['name']."</option>";
			}
	   GetCategory($mang,$value['id'],$shift.'---|',$select);
   }
}

}



function ShowCategory($mang,$parent,$shift)
{
	
foreach($mang as $value)
{
   if($value['parent']==$parent)
   {
      echo '<div class="item-menu"><span>'.$shift.$value['name'].'</span>
               <div class="category-fix">
                  <a class="btn-category btn-primary" href="/admin/category/edit/'.$value['id'].'"><i class="fa fa-edit"></i></a>
                  <a class="btn-category btn-danger" href="/admin/category/del/'.$value['id'].'"><i class="fas fa-times"></i></i></a>
               </div>
            </div>';
	   ShowCategory($mang,$value['id'],$shift.'----|');
   }
}

}