

                        <td colspan="3">  
            <?php if ($permission) { ?>
                                <a href="/step/insert/id/<?php echo $item['id']; ?>"><i class="icon-chevron-right" rel="tooltip" title="Insert a new step before this step"></i></a> 
                                <a href="/step/delete/id/<?php echo $item['id']; ?>"><i class="icon-remove-sign" rel="tooltip" title="Delete this step"></i></a> 
                                <a href="/step/update/flow/1/id/<?php echo $item['id']; ?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
            <?php } ?> 
                            <b>Step <?php echo $item['number']; ?>:</b> 
                        </td> 
                    </tr>

                    <tr>
                        <td> <b>Action:</b><br />
            <?php echo $item['text']; ?>
                            <br />
                            <b>Result:</b><br /><?php echo $item['result']; ?>
                        </td>
                        <td>

                            <?php
                            $links = Step::model()->getStepLinks($item['id'], 12, 15);
                            if (count($links)) {
                                ?>

                                <strong>Interfaces</strong>
                                <br />
                                <?php foreach ($links as $link) { ?>
                                    <a href="/iface/view/id/<?php echo $link['iface_id']; ?>">UI-<?php echo str_pad($link['number'], 4, "0", STR_PAD_LEFT); ?></a>  <?php echo $link['name']; ?> 
                                    <a href="/stepiface/delete/id/<?php echo $link['xid']; ?>"><i class="icon-remove-sign"></i></a><br/>
                                <?php } ?>
                                <br />
            <?php } ?>



                            <?php
                            $links = Step::model()->getStepLinks($item['id'], 1, 16);
                            if (count($links)) {
                                ?>

                                <strong>Rules</strong>
                                <br />
                <?php foreach ($links as $link) { ?>
                                    <a href="/rule/view/id/<?php echo $link['rule_id']; ?>">BR-<?php echo str_pad($link['number'], 4, "0", STR_PAD_LEFT); ?></a>  <?php echo $link['name']; ?> 
                                    <a href="/steprule/delete/id/<?php echo $link['xid']; ?>"><i class="icon-remove-sign"></i></a>
                                    <br />
                                <?php } ?>
                                <br />

            <?php } ?>



                            <?php
                            $links = Step::model()->getStepLinks($item['id'], 2, 14);
                            if (count($links)) {
                                ?>

                                <strong>Forms</strong>
                                <br />
                                <?php foreach ($links as $link) { ?>
                                    <a href="/form/view/id/<?php echo $link['form_id']; ?>">UF-<?php echo str_pad($link['number'], 4, "0", STR_PAD_LEFT); ?> </a> <?php echo $link['name']; ?> 
                                    <a href="/stepform/delete/id/<?php echo $link['xid']; ?>"><i class="icon-remove-sign"></i></a>
                                    <br />
                                <?php } ?>
                            </td></tr>
                            <?php } ?>