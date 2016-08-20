<?php  ?>
La entidad que intenta borrar tiene otras entidades asociadas, borre esas primero e intente nuevamente.
<br>
<br>
<br>
<?php echo $this->Form->button('Volver', array('type' => 'button', 'onClick' => 'javascript:history.back(1)', 'class' => 'btn btn-red')); ?>

<?php
if (Configure::read('debug') > 0):
    echo $message;
    echo "<br>";
    echo $this->element('exception_stack_trace');
endif;
?>