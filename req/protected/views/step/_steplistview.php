

                        <td colspan="3">  
            <?php if ($edit) { ?>
                                <a href="<?php echo UrlHelper::getPrefixLink('/step/insert/id/')?><?php echo $item['id']; ?>"><i class="icon-chevron-right" rel="tooltip" title="Insert a new step before this step"></i></a> 
                                <a href="<?php echo UrlHelper::getPrefixLink('/step/delete/id/')?><?php echo $item['id']; ?>"><i class="icon-remove-sign" rel="tooltip" title="Delete this step"></i></a> 
                                <a href="<?php echo UrlHelper::getPrefixLink('/step/update/flow/1/id/')?><?php echo $item['id']; ?>"><i class="icon-edit" rel="tooltip" title="Edit"></i></a> 
            <?php } ?> 
                            <b>Step <?php echo $item['number']; ?>:</b> 
                        </td> 
                    </tr>

                    <tr>
                        <td> <b>Action:</b><br />
            <?php 
            
               echo  Version::model()->wikiOutput($item['text'],0);
             ?>
                            <br />
                            <b>Result:</b><br />
                             <?php 
            
               echo  Version::model()->wikiOutput($item['result'],0);
             ?>
                        </td>
                        <td>

                            <?php
                            $links = Step::model()->getStepLinks($item['id'], 12, 15);
                            if (count($links)) {
                                ?>

                                <strong>Interfaces</strong>
                                <br />
                                <?php foreach ($links as $link) { 
                                    
                                    $category=Iface::model()->getIfaceType($link['iface_id']);
                                    ?>
                                    <a href="<?php echo UrlHelper::getPrefixLink('/iface/view/id/')?><?php echo $link['iface_id']; ?>">
                                    <?php echo Version::$numberformat[12]['prepend']?>-
                                    <?php echo str_pad($category['typenumber'], 2, "0", STR_PAD_LEFT ).str_pad($link['number'], Version::$numberformat[12]['padding'], "0", STR_PAD_LEFT); ?>
                                    </a>  <?php echo $link['name']; ?> 
                                    <a href="<?php echo UrlHelper::getPrefixLink('/stepiface/delete/id/')?><?php echo $link['xid']; ?>"><i class="icon-unlink text-error" rel="tooltip" title="Unlink this interface"></i></a><br/>
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
                                    <a href="<?php echo UrlHelper::getPrefixLink('/rule/view/id/')?><?php echo $link['rule_id']; ?>">BR-<?php echo str_pad($link['number'], 4, "0", STR_PAD_LEFT); ?></a>  <?php echo $link['name']; ?> 
                                    <a href="<?php echo UrlHelper::getPrefixLink('/steprule/delete/id/')?><?php echo $link['xid']; ?>"><i class="icon-unlink text-error" rel="tooltip" title="Unlink this interface"></i></a>
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
                                    <a href="<?php echo UrlHelper::getPrefixLink('/form/view/id/')?><?php echo $link['form_id']; ?>">UF-<?php echo str_pad($link['number'], 4, "0", STR_PAD_LEFT); ?> </a> <?php echo $link['name']; ?> 
                                    <a href="<?php echo UrlHelper::getPrefixLink('/stepform/delete/id/')?><?php echo $link['xid']; ?>"><i class="icon-unlink text-error" rel="tooltip" title="Unlink this interface"></i></a>
                                    <br />
                                <?php } ?>
                            </td></tr>
                            <?php } ?>