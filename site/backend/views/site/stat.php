<?php
echo 'Статей: '.CommunityContent::model()->count('type_id = 1 AND removed = 0').'<br>';
echo 'Видео: '.CommunityContent::model()->count('type_id = 2 AND removed = 0').'<br>';
echo 'Утро с Веселым Жирафом: '.CommunityContent::model()->count('type_id = 4 AND removed = 0').'<br>';
echo 'Путешествий: '.CommunityContent::model()->count('type_id = 3 AND removed = 0').'<br>';
echo 'Имен: '.Name::model()->count().'<br>';
echo 'Рецептов: '.RecipeBookRecipe::model()->count().'<br>';
echo 'Болезней: '.RecipeBookDisease::model()->count().'<br>';