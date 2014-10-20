delimiter $$

CREATE DEFINER=`rrs`@`localhost` PROCEDURE `changeActor`(
	in old_actor int, 
	in new_actor int,
	out is_success int
)
BEGIN
	set is_success = 0;
	update `step` set `step`.`actor_id` = new_actor where `step`.`actor_id` = old_actor;
    update `usecase` set `usecase`.`actor_id` = new_actor where `usecase`.`actor_id` = old_actor;
    update `usecase` set `usecase`.`actor_id` = new_actor where `usecase`.`actor_id` = old_actor;
    set is_success = 1;
END$$
