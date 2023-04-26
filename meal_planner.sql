-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 11:34 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meal_planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `meal_planner`
--

CREATE TABLE `meal_planner` (
  `planner_id` int(11) NOT NULL,
  `availability` enum('available','unavailable') DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') DEFAULT NULL,
  `ingredients` longtext NOT NULL,
  `meal_description` longtext NOT NULL,
  `meal_date` date NOT NULL,
  `meal_time` time NOT NULL,
  `fk_type_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_recipe_id` int(11) DEFAULT NULL,
  `recipe_name` varchar(255) DEFAULT NULL,
  `food_type` varchar(255) DEFAULT NULL,
  `fk_day_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meal_planner`
--

INSERT INTO `meal_planner` (`planner_id`, `availability`, `picture`, `day`, `ingredients`, `meal_description`, `meal_date`, `meal_time`, `fk_type_id`, `fk_user_id`, `fk_recipe_id`, `recipe_name`, `food_type`, `fk_day_id`) VALUES
(810, NULL, '641c4aac94e4e.jpg', 'Tuesday', '4 Frescados Spinach Wraps <br>1 tbsp vegetable oil <br>1 onion, chopped <br>1 green pepper, seeded and chopped <br>1/2 tsp chili powder <br>1/2 tsp ground cumin <br>1/4 tsp each salt and cayenne pepper <br>8 strips bacon, cooked and crumbled <br>2 cups shredded iceberg lettuce <br>2 tomatoes, diced Lime wedges <br>Avocado Crema: <br>1 ripe avocado <br>1/4 cup mayonnaise or sour cream <br>2 tsp lime juice <br>1/2 tsp ground cumin <br>1/4 tsp each salt and pepper', 'First, prepare the avocado salsa. Place the avocado, tomatoes, shallot, garlic, jalapeño, lime juice and fresh coriander in a bowl and mix to combine. Set aside. Preheat the oven to 200°C. Next, in a second bowl, whisk the eggs with the smoked paprika. Then, heat a pan, over medium heat and add the chorizo and sausages. Cook, stirring frequently for 4-5 minutes until coloured, break down large lumps with the spoon if needed. Remove from the heat. In a second saucepan, add the egg mixture and the butter. Cook until scrambled, for 3-4 minutes, constantly stirring with a spoon to create scrambled eggs. Once nearly cooked, remove from the heat and season well.  To finish, build the burritos. Lay each tortilla on a work surface, spread some of the avocado salsa, spoon on the chorizo and sausage mixture. Next add the eggs and scatter some of the grated cheese. Fold each tortilla over the filling into tucked rolls. Place on a baking tray andheat through in the oven for 5 minutes until the cheese is just melted. Serve immediately.', '4524-02-25', '11:11:00', NULL, 72, 314, 'Burrito', 'Breakfast', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ingredients` longtext NOT NULL,
  `meal_description` longtext NOT NULL,
  `cooking_prep_time` int(11) NOT NULL,
  `calories` int(11) NOT NULL,
  `food_type` enum('Breakfast','Lunch','Dinner','Vegan','Vegeterian') DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_planner_id` int(11) DEFAULT NULL,
  `fk_type_id` int(11) DEFAULT NULL,
  `fk_recipe_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_id`, `name`, `ingredients`, `meal_description`, `cooking_prep_time`, `calories`, `food_type`, `picture`, `video`, `fk_user_id`, `fk_planner_id`, `fk_type_id`, `fk_recipe_id`) VALUES
(312, 'Pasta Carbonara', '1 tablespoon extra virgin olive oil or unsalted butter <br>1/2 pound pancetta or thick cut bacon diced <br>1 to 2 garlic cloves, minced, about 1 teaspoon (optional) <br>3 to 4 whole eggs<br>1 cup grated Parmesan or pecorino cheese<br>1 pound spaghetti (or bucatini or fettuccine)<br>Kosher salt and freshly ground black pepper to taste', 'Heat a little oil in a large pan and fry the bacon until crispy. Beat together the egg yolks and Parmesan in a bowl, and season lightly with cracked black pepper. <br>  Bring a large saucepan of water to the boil, add salt, and then cook the spaghetti as per pack instructions, until al dente. <br>  Stir once or twice during the cooking process to ensure that it does not stick together. Drain the pasta and return it to the saucepan, remove from the heat. <br>  Add the bacon, crème fraiche and the egg mixture and stir gently with a wooden spoon to ensure the pasta is fully coated. <br>  Serve immediately in warmed bowls, and sprinkle with a little extra Parmesan and cracked black pepper if you like. ', 35, 570, 'Lunch', '641c43ff299df.jpg', 'https://www.youtube.com/watch?v=6Oy5ITdDQ3o&t=3s', 72, NULL, NULL, NULL),
(314, 'Burrito', '4 Frescados Spinach Wraps <br>1 tbsp vegetable oil <br>1 onion, chopped <br>1 green pepper, seeded and chopped <br>1/2 tsp chili powder <br>1/2 tsp ground cumin <br>1/4 tsp each salt and cayenne pepper <br>8 strips bacon, cooked and crumbled <br>2 cups shredded iceberg lettuce <br>2 tomatoes, diced Lime wedges <br>Avocado Crema: <br>1 ripe avocado <br>1/4 cup mayonnaise or sour cream <br>2 tsp lime juice <br>1/2 tsp ground cumin <br>1/4 tsp each salt and pepper', 'First, prepare the avocado salsa. Place the avocado, tomatoes, shallot, garlic, jalapeño, lime juice and fresh coriander in a bowl and mix to combine. Set aside. Preheat the oven to 200°C. Next, in a second bowl, whisk the eggs with the smoked paprika. Then, heat a pan, over medium heat and add the chorizo and sausages. Cook, stirring frequently for 4-5 minutes until coloured, break down large lumps with the spoon if needed. Remove from the heat. In a second saucepan, add the egg mixture and the butter. Cook until scrambled, for 3-4 minutes, constantly stirring with a spoon to create scrambled eggs. Once nearly cooked, remove from the heat and season well.  To finish, build the burritos. Lay each tortilla on a work surface, spread some of the avocado salsa, spoon on the chorizo and sausage mixture. Next add the eggs and scatter some of the grated cheese. Fold each tortilla over the filling into tucked rolls. Place on a baking tray andheat through in the oven for 5 minutes until the cheese is just melted. Serve immediately.', 20, 310, 'Breakfast', '641c4aac94e4e.jpg', 'https://www.youtube.com/watch?v=t0Mr88d9eK4', 71, NULL, NULL, NULL),
(315, 'Beef Stuffed Peppers', '1/2 c. uncooked rice <br>2 tbsp. extra-virgin olive oil, plus more for drizzling <br>1 medium onion, chopped <br>2 tbsp. tomato paste <br>3 cloves garlic, minced <br>1 lb. ground beef <br>1 (14.5-oz.) can diced tomatoes <br>1 1/2 tsp. dried oregano Kosher salt Freshly ground black pepper <br>6 bell peppers, tops and cores removed <br>1 c. shredded Monterey jack Freshly chopped parsley, for garnish', 'Preheat the oven to 190oC/gas mark 5. Place the halved peppers on a baking tray, cut side up. Cover with foil and bake in the oven for 15 minutes, until soft. Meanwhile, warm the oil in a non-stick frying pan set over a medium heat. Add the beef, onion, mushrooms and garlic and fry for 10 minutes, then add the tomato purée and cook for 1 or 2 minutes more. Add the spinach and cook until it has wilted right down. Remove the peppers from the oven and spoon in the beef filling. Sprinkle the Parmesan cheese on top and return to the oven for another 5 minutes, until the beef is completely cooked through and the cheese has melted. Tip: Allow your peppers to cook until they are just becoming soft and brush with a little olive oil to stop them burning at the edges.', 35, 300, 'Lunch', '641c4b93c11c2.jpg', 'https://www.youtube.com/watch?v=nRSO-8bGu3o', 75, NULL, NULL, NULL),
(318, 'One Pot Vegan Lasagne', '0.5 tsp Garlic Powder optional <br>3 tbsp Nutritional Yeast optional <br>0.5 tsp Onion Powder optional <br>300 g Raw Cashew Nuts <br>1.5 tbsp White Wine Vinegar or lime juice <br>150 ml Vegetable Stock <br>300 ml Water <br>For the tomato sauce: 0.25 tsp Black Pepper <br>800 g Chopped Tomatoes <br>3 cloves Garlic finely chopped <br>1 tbsp Maple Syrup <br>200 g Mushrooms finely sliced <br>2 tbsp Olive Oil <br>1 - Onion finely chopped <br>100 ml Red Wine <br>0.5 tsp Salt <br>5 - Sun Dried Tomatoes in Oil drained and finely chopped <br>1 - Courgette halved and thinly sliced <br>0.5 -  Fresh Red Chilli deseeded and finely chopped<br>100 g Tomato Purée', 'First soak the cashew nuts in the water for 30 minutes. Preheat the oven to 180°C/gas mark 4.<br>  Heat the oil in a large ovenproof pot set over a high heat on the hob.<br>  Add the onion, garlic and chilli and fry for 2 minutes, stirring regularly, until the garlic is turning golden and the onions are turning transparent. <br> Now add the mushrooms and courgette and fry for 5 minutes, stirring regularly. <br> Add the red wine and allow to reduce for 2 minutes, then add the chopped tomatoes, tomato purée, sun-dried tomatoes, maple syrup, salt and pepper. <br> Bring to the boil, then reduce the heat and simmer for 10 minutes. To make the cashew cream, drain and rinse the soaked cashews. <br> Put all the ingredients for the cashew cream in a blender and blend until really smooth. Season with salt and pepper to taste. <br> Now to layer up, remove half of the tomato and veg sauce from the pot. Cover the remaining sauce in the pot with a layer of lasagne sheets, breaking the sheets so that it forms an even layer with no sheets overlapping. <br> Spoon on half of the cashew cheese and spread it to the edges so that it’s a nice even layer. Add the remaining tomato and veg sauce back in and spread it out evenly. <br> Top with another layer of lasagne sheets like you did before, with no sheets overlapping. Spoon on the remaining cashew cheese. <br> Bake in the oven for 15 minutes, until the cashew cream starts to turn solid. Remove from the oven and allow to stand for 5 minutes before dishing up.', 45, 290, 'Vegan', '641c4eb302b93.jpg', 'https://www.youtube.com/watch?v=iKQkczcj1Rs&t=3s', 45, NULL, NULL, NULL),
(319, 'BBQ Ribs', '2 racks pork spareribs, about 8 to 10 pounds <br>3 tablespoons soy sauce <br>3 tablespoons hoisin sauce <br>3 tablespoons ketchup <br>2 tablespoons Chinese rice wine, or dry sherry <br>1 tablespoon brown sugar <br>2 clove garlic, finely chopped <br>2 tablespoons honey <br>1/4 cup water', '1. The day before or a few hours ahead, preheat the oven to 180˚C. Place the onion, garlic, sugar, smoked paprika, thyme, stock, tomato puree, half of the smoky barbecue sauce and water in a large saucepan over high heat and bring to the boil.  2. Place the ribs in a roasting tray and pour the hot liquid over the ribs. Cover with foil and place in the oven for 40-45 minutes until the ribs are tender. Remove from the oven and leave to cool for 30 minutes or until ready to use (if using the next day place in the fridge when cooled covered with cling film).  3. Preheat the barbecue over medium heat.  4. Lift the ribs from the cooking liquid onto a board. Brush the remaining barbecue sauce evenly over the ribs to coat.  5. Place the ribs on the barbecue over indirect heat if you can and grill for 20 minutes, brushing with the marinade every 5 minutes, or until golden and sticky.  6. Serve with your favourite sides.', 70, 385, 'Dinner', '641c4f934c085.jpg', 'https://www.youtube.com/watch?v=yTIcV5EIqdM', 71, NULL, NULL, NULL),
(320, 'Simple Fast Oats', '½ cup (50 g) rolled oats <br>½ cup (120 ml) unsweetened Almond Breeze Almondmilk <br>¾ tablespoon honey or pure maple syrup <br>¼ teaspoon pure vanilla extract<br>¼ cup (25 g) fresh or frozen blueberries', 'Place the porridge oats in a serving bowl and pour in enough water to just cover the oats. Cook in the microwave for 1 minute. Remove from the microwave and stir in the berries, whey protein (if using), Greek yogurt, milled seeds and oil (if solid, the coconut oil will melt in the warm porridge). Mix well and sprinkle with a pinch of cinnamon. Serve straight away.', 5, 150, 'Breakfast', '641c50de2da39.png', 'https://www.youtube.com/watch?v=7FTCi6tiEA0', 75, NULL, NULL, NULL),
(321, 'Veggie Spiral Pie', '1 tbsp cumin seeds <br>1 tbsp coriander seeds <br>3 tbsp olive or rapeseed oil <br>2 onions, halved and thinly sliced <br>100g green lentils <br>300g basmati rice <br>4 garlic cloves, crushed <br>1 nutmeg <br>½ tsp ground turmeric <br>½ tsp allspice <br>400g spinach small bunch dill, <br>finely chopped small bunch parsley, <br>finely chopped small bunch mint, <br>finely chopped zest <br>2 lemon, plus juice of 1 <br>200g pack feta (check pack label to find a vegetarian brand), <br>crumbled 2 x 270g packs filo pastry (12 sheets in total) <br>100g butter, melted <br>1 egg, beaten <br>1 tsp black sesame seed (or regular sesame seeds) <br>Greek yogurt, to serve For the tomato sauce <br>2 x cans chopped tomato <br>1 tbsp red wine vinegar <br>2 tsp sugar (any will do) <br>1 tsp ground cinnamon <br>2 tbsp olive oil For the salad <br>1 cucumber <br>1 onion, finely chopped <br>2 large tomatoes, <br>finely chopped handful parsley, chopped <br>1 tbsp red wine vinegar <br>2 tbsp extra virgin olive oil', 'STEP 1 Heat a large saucepan, tip in the cumin and coriander seeds and toast for a few mins until you can smell their fragrance and they turn a shade darker, then tip into a pestle and mortar. Add the oil to the pan, then tip in the onions and cook slowly until golden and caramelised – this will take 15-20 mins. Meanwhile, bring 2 pans of water to the boil. Add the lentils to 1 pan and cook for 20 mins. Put the rice and a pinch of salt in the other pan and cook for 5 mins (it should still have a little bite). Drain both pans, and leave the lentils and rice to steam-dry.  STEP 2 Boil the kettle. Stir the garlic into the onions and cook for 1-2 mins over a low heat. Grind the whole spices in the pestle and mortar to a fine powder and add these to the onion mixture. Grate half of the nutmeg and add to the onions with the turmeric and allspice.  STEP 3 Put the spinach in a colander in the sink, pour over a kettle of boiling water, then rinse under cold water. Use your hands to squeeze out as much liquid as possible. Finely chop the spinach and add to the onions with the herbs, lemon zest and juice and the rice, lentils and plenty of seasoning. Leave to cool before stirring through the feta.  STEP 4 To assemble the pie, you’ll need plenty of space on your work surface – about 1 metre. Unwrap the filo and cover with a damp tea towel. Have your bowls of melted butter and beaten egg to hand, as well as a pastry brush for each. Working quickly, lay 4 sheets of filo end to end, running along the length of your work surface, and butter each piece generously, overlapping each sheet by about 10cm. Top with another 4 sheets, butter well, then repeat with 3 final sheets of filo (save the last one to cover any cracks later on.)  STEP 5 Spoon the rice filling down the centre of the filo, leaving 5cm free on either end. Brush the egg around the edges and tuck the ends in to cover the filling. Starting from one end, roll the filo over the filling, working your way along until you have a long filo sausage. From one end, start to coil the sausage back on itself – if the pastry cracks, patch it over the hole with your reserved piece of filo. When the coil is complete, slide onto a tray lined with baking parchment, brush the top with beaten egg and sprinkle over the sesame seeds. You can now cover it loosely with cling film and chill for up to 24 hrs.  STEP 6 When you’re ready to bake, heat oven to 200C/180C fan/gas 6. Place the pie on the middle shelf and bake for 45 mins until golden and crisp. Meanwhile, tip the ingredients for the tomato sauce into a pan, season and bubble for 30 mins until rich and thick.  STEP 7 For the salad, halve the cucumber through the centre, then cut in half lengthways and chop into small cubes. Put in a bowl, add the remaining ingredients and season well. Set aside until ready to serve.  STEP 8 Leave the pie to cool for 20 mins before serving with the sauce, salad and a large bowl of yogurt.', 70, 525, 'Vegeterian', '641c51f8999a3.jpg', 'https://www.youtube.com/watch?v=eev0lZZ3y4o', 75, NULL, NULL, NULL),
(323, 'Stuffed Pumpkin', '1 medium-sized pumpkin or round squash (about 1kg) <br>4 tbsp olive oil <br>100g wild rice <br>1 large fennel bulb <br>1 Bramley apple <br>1 lemon, zested and juiced <br>1 tbsp fennel seeds <br>½ tsp chilli flakes <br>2 garlic cloves, crushed <br>30g pecans, toasted and roughly chopped <br>1 large pack parsley, roughly chopped <br>3 tbsp tahini pomegranate seeds', 'STEP 1 Heat oven to 200C/180C fan/gas 6. Cut the top off the pumpkin or squash and use a metal spoon to scoop out the seeds. Get rid of any pithy bits but keep the seeds for another time (see our pumpkin seed recipe ideas). Put the pumpkin on a baking tray, rub with 2 tbsp of the oil inside and out, and season well. Roast in the centre of the oven for 45 mins or until tender, with the ‘lid’ on the side.  STEP 2 Meanwhile, rinse the wild rice well and cook following pack instructions, then spread out on a baking tray to cool. Thinly slice the fennel bulb and apple, then squeeze over ½ the lemon juice to stop them discolouring.  STEP 3 Heat the remaining 2 tbsp oil in a frying pan. Fry the fennel seeds and chilli flakes, then, once the seeds begin to pop, stir in ½ the garlic and the fennel. Cook for 5 mins until softened, then mix through the apple, pecans and lemon zest. Remove from the heat. Add the mixture to the the cooked rice, then stir in the chopped parsley and taste for seasoning.  STEP 4 Pack the mixture into the cooked pumpkin and return to the oven for 10-15 mins until everything is piping hot. Meanwhile, whisk the remaining lemon juice with the tahini, the rest of the garlic and enough water to make a dressing. Serve the pumpkin in the middle of the table, topped with pomegranate seeds and the dressing.', 20, 620, 'Vegeterian', '641c52fa7d924.jpg', 'https://www.youtube.com/watch?v=gIvOh8J_dh8', 72, NULL, NULL, NULL),
(324, 'Blueban Pancakes', '1 ripe medium banana, just under ½ cup (110g) mashed <br>⅔ cup original Almond Breeze Almond Milk <br>1 teaspoon vanilla <br>¾ cup (90g) flour <br>1 teaspoon baking powder <br>½ teaspoon cinnamon <br>⅛ teaspoon salt <br>¼ cup (25g) blueberries, plus more for topping a few teaspoons coconut oil, for the pan maple syrup', 'Combine the mashed bananas and eggs in a large mixing bowl. Stir in the ground almonds, ground linseed, baking powder and cinnamon, then fold in the blueberries. Heat a little oil in a frying pan set over a low heat. Spoon in some of the pancake batter and cook over a very low heat. Take your time and don’t rush. When the pancakes are golden brown on the bottom, flip them over and cook the other side until golden brown. Drizzle with honey and serve with natural yogurt. This recipe makes 5 pancakes.', 10, 320, 'Breakfast', '641c53df950ad.jpg', 'https://www.youtube.com/watch?v=mefNbzpJfZE', 72, NULL, NULL, NULL),
(333, 'Pork Chops', '1 kg potatoes <br>4 higher-welfare pork loin chops , skin and fat on olive oil <br>½ a bunch of fresh sage <br>1 big bunch of watercress <br>1 sprig fresh flat-leaf parsley <br>4 spring onions <br>300 ml milk <br>2 fresh bay leaves unsalted butter', 'STEP 1 Heat the oven to 200C/fan 180C/gas 6. Toss the potatoes, oil, garlic and thyme on a shallow roasting tray and mix will with your hands to coat in the oil. Season well. Roast for 25 mins until the potatoes are just turning tender when pierced with a knife.  STEP 2 Whisk the honey and mustard together in a small bowl. Season the pork chops with salt and pepper, then brush with half the marinade. Nestle into the potatoes on the tray, and bake for another 10 mins before turning the chops and spooning over the remaining glaze. Continue to bake for 10 more mins until cooked through.', 55, 800, 'Dinner', '642031d6408c2.jpg', 'https://www.youtube.com/watch?v=mNjH5bwyZ1k', 71, NULL, NULL, 0),
(427, 'Vegan Chilli', '3 tbsp olive oil <br>2 sweet potatoes, peeled and cut into medium chunks <br>2 tsp smoked paprika <br>2 tsp ground cumin <br>1 onion, chopped <br>2 carrots, chopped <br>2 celery sticks, chopped <br>2 garlic cloves, crushed <br>1-2 tsp chilli powder <br>1 tsp dried oregano <br>1 tbsp tomato purée <br>1 red pepper, cut into chunks <br>2 x 400g cans chopped tomatoes <br>400g can black beans, drained <br>400g can kidney beans, drained lime wedges, guacamole, rice and coriander', 'Method STEP 1 Heat the oven to 200C/180C fan/gas 6. Put the sweet potato in a roasting tin and drizzle over 1½ tbsp oil, 1 tsp smoked paprika and 1 tsp ground cumin. Give everything a good mix so that all the chunks are coated in spices, season with salt and pepper, then roast for 25 mins until cooked.  STEP 2 Meanwhile, heat the remaining oil in a large saucepan over a medium heat. Add the onion, carrot and celery. Cook for 8-10 mins, stirring occasionally until soft, then crush in the garlic and cook for 1 min more. Add the remaining dried spices and tomato purée. Give everything a good mix and cook for 1 min more.  STEP 3 Add the red pepper, chopped tomatoes and 200ml water. Bring the chilli to a boil, then simmer for 20 mins. Tip in the beans and cook for another 10 mins before adding the sweet potato. Season to taste then serve with lime wedges, guacamole, rice and coriander. Will keep, in an airtight container in the freezer, for up to three months.  To make in a slow cooker Heat the oil in a large frying pan over a medium heat. Add the onion, carrot and celery. Cook for 8-10 mins, stirring occasionally until soft, then crush in the garlic, tip in the sweet potato chunks and cook for 1 min more. Add all the dried spices, oregano and tomato purée, cook for 1 min, then tip into a slow cooker.  Add the red pepper and chopped tomatoes. Give everything a good stir then cook on low for 5 hrs. Stir in the beans and cook for another 30 mins to 1 hr. Season to taste and serve with lime wedges, guacamole, rice and coriander.', 75, 370, 'Vegan', '6423ffaee47eb.jpg', 'https://www.youtube.com/watch?v=DkAF6npVKh4', 72, NULL, NULL, 0),
(428, 'Beef Goulash Soup', '1 tbsp rapeseed oil <br>1 large onion, halved and sliced <br>3 garlic cloves, sliced <br>200g extra lean stewing beef, finely diced <br>1 tsp caraway seeds <br>2 tsp smoked paprika <br>400g can chopped tomatoes <br>600ml beef stock <br>1 medium sweet potato, peeled and diced <br>1 green pepper, deseeded and diced Supercharged topping <br>150g pot natural bio yogurt good handful parsley, chopped', 'STEP 1 Heat the oil in a large pan, add the onion and garlic, and fry for 5 mins until starting to colour. Stir in the beef, increase the heat and fry, stirring, to brown it.  STEP 2 Add the caraway and paprika, stir well, then tip in the tomatoes and stock. Cover and leave to cook gently for 30 mins.  STEP 3 Stir in the sweet potato and green pepper, cover and cook for 20 mins more or until tender. Allow to cool a little, then serve topped with the yogurt and parsley (if the soup is too hot, it will kill the beneficial bacteria in the yogurt).', 120, 345, 'Dinner', '64240132783d0.jpg', 'https://www.youtube.com/watch?v=I1fZHQgJPtg', 72, NULL, NULL, 0),
(429, 'Carrot Soup', '2 tablespoons unsalted butter <br>1 large white onion, chopped <br>2 pounds carrots, peeled and chopped <br>3 clove garlic, chopped <br>1 teaspoon dried thyme <br>4 cups vegetable stock <br>1/2 teaspoon salt <br>1/2 teaspoon white pepper, optional <br>4 tablespoons heavy cream, divided', ' Wash hands with soap and water. In a large pot, melt margarine or butter on medium heat. Add celery and onion and sauté until soft, 3 to 5 minutes. Add carrots, broth and water. Bring mixture to a boil, then reduce heat to low. Cover the pot and simmer for about 30 minutes. Remove pot from heat and uncover. Let the soup cool for about 5 minutes. Stir several times to help release heat. Puree the soup in batches in a blender, using the manufacturers directions for pureeing hot liquids, or use an immersion blender. Add salt, pepper and parsley. Serve warm. Refrigerate leftovers within 2 hours.', 25, 90, 'Vegeterian', '64255f30d722e.jpg', 'https://www.youtube.com/watch?v=1xrhaL3WmaY', 71, NULL, NULL, 0),
(430, 'Smoked Salmon', '2 tbsp half-fat soured cream <br>2 tbsp lemon juice <br>½ pack dill, finely chopped <br>250g pouch ready-to-eat quinoa <br>½ cucumber, halved and sliced <br>4 radishes, finely sliced <br>100g smoked salmon, torn into strips', 'STEP 1 First, make the dressing. Mix the soured cream and lemon juice together in a bowl, then add most of the dill, reserving a quarter for serving.  STEP 2 In another bowl, combine the quinoa with the cucumber and radishes, and stir through half the dressing. Season and top with the salmon and the rest of the dill.  STEP 3 Put the other half of the dressing in a small pot and drizzle over the quinoa just before serving.', 20, 250, 'Lunch', '642562d1e3e6b.jpg', 'https://www.youtube.com/watch?v=Xs-y3WrXLOg', 45, NULL, NULL, 0),
(431, 'Guacamole', '3 avocados - peeled, pitted, and mashed  <br>1 lime, juiced  <br>1 teaspoon salt  <br>2 roma tomatoes, diced  <br>½ cup diced onion <br>3 tablespoons chopped fresh cilantro <br>1 teaspoon minced garlic  <br>1 pinch ground cayenne pepper', 'STEP 1 Use a large knife to pulverise 1 large ripe tomato to a pulp on a board, then tip into a bowl.  STEP 2 Halve and stone the 3 avocados (saving a stone) and use a spoon to scoop out the flesh into the bowl with the tomato.  STEP 3 Tip the juice of 1 large lime, a handful of roughly chopped coriander, 1 finely chopped small red onion and 1 deseeded and finely chopped red or green chilli into the bowl, then season with salt and pepper.  STEP 4 Use a whisk to roughly mash everything together. If not serving straight away, sit a stone in the guacamole (this helps to stop it going brown), cover with cling film and chill until needed.', 15, 110, 'Vegan', '64256470aebd6.jpg', 'https://www.youtube.com/watch?v=K06J2pFY6yU', 72, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_reviews`
--

CREATE TABLE `recipe_reviews` (
  `review_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `fk_recipe_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipe_reviews`
--

INSERT INTO `recipe_reviews` (`review_id`, `message`, `fk_recipe_id`, `rating`, `fk_user_id`) VALUES
(205, ' This carbonara looks like it would smell and taste absolutely amazing! A party for the taste buds. Thank you @JohnRedman22 for sharing yet another great recipe.', 312, 5, 76),
(206, 'What a delight! A wonderful, interesting autumnal vegan feast. But took long time to prepare. The pumpkin, tahini and pecans blend beautifully together. I will be keeping this for special occasions. \r\n', 323, 4, 45),
(207, 'We really enjoyed these pancakes. They were very thick, but still delicious and cooked completely.  Next time I might try adding a little extra milk..\r\nEdit: The next time I made them I used 1 1/2 cups of soy milk and that seemed perfect to me!', 324, 4, 77),
(208, 'This is so bland and uninteresting. I doubled the cinnamon, used all milk and extra honey... Still bland. :|', 320, 2, 77),
(209, 'Really lovely recipe, we followed it to the letter and it was delicious. Personally I’m not too worried about the authenticity, it tasted great and we all enjoyed it. Quick and easy too!', 312, 5, 77),
(210, 'Wow, what an amazing pork chops recipe from Jamie! Looks packed with flavor.', 333, 5, 77),
(211, 'Delicious recipe. I swapped the wholmeal wrap out for a Flaxseed one to reduce carbs. I had a little trouble fitting it all in the wrap, but still tasted great.', 314, 4, 72),
(212, 'I served this to some vegetarian friends over the weekend and everyone loved it. Lovely flavours and not dry at all when served with the sauce and yogurt. Leftovers were great for lunch the next day too.', 321, 5, 72),
(213, ' Thanks for sharing this recipe, but it could be better!', 320, 3, 72),
(214, 'Easy to make. I added more mushrooms and onion and less mince (had a smaller pack of mince). I also added chilli powder, gave it a lovely little kick. :)', 315, 4, 72),
(215, 'Yum, best vegan dish I have ever made, the only difference i made was i put more salt in the ragu and the bechamel. I also used red wine vinegar in place of red wine in the ragu. Really tasty warming meal. I highly recommend.', 318, 5, 72),
(216, ' Very interesting recipe!', 323, 5, 71),
(217, 'Very healthy Lasagne. 🤗👍', 318, 5, 71),
(218, ' Perfect! 👍', 427, 5, 71),
(220, ' I love these straight dishes, Jamie your recipes help me discover great tastes and it is so easy. I want more! 😊😊😊😊', 314, 5, 76),
(221, 'I gotta try making this! It looks delicious.😋😋\r\n\r\n', 323, 5, 76),
(222, ' 😩😩😩😩', 320, 1, 76),
(223, 'This is one of the best recipes. Just well done all around. 👌👌👌', 319, 5, 76),
(224, ' 👌👌', 318, 5, 76),
(225, ' Not my favorite!', 430, 2, 76),
(226, 'I absolutly love them ingredients, gonna try something like this out very soon! 👍👍', 431, 5, 45);

-- --------------------------------------------------------

--
-- Table structure for table `review_message`
--

CREATE TABLE `review_message` (
  `id_message` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `fk_review_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` enum('USER','ADMIN') NOT NULL,
  `user_block` enum('blocked','unblocked') DEFAULT NULL,
  `fk_planner_id` int(11) DEFAULT NULL,
  `fk_recipe_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `password`, `email`, `photo`, `status`, `user_block`, `fk_planner_id`, `fk_recipe_id`) VALUES
(9, 'jode', 'Dejan', 'Bicok', 'cbac07cd70e4f319f42950534cfda8d0c10a7d4d614fd04f0cfd9cc35f4472dc', 'jode@mail.com', '63f39159c4f69.jpg', 'ADMIN', '', NULL, NULL),
(45, 'Titan Wolf', 'Titan', 'Wolf', 'e7ea38b28519c2d60d2053e0bd82135098dadacf8a92db0b46457000b7c458b3', 'titan@mail.com', '63f3ee6e67287.png', 'USER', '', NULL, NULL),
(71, 'Jamie Oliver', 'Jamie', 'Oliver', '3d2b496745014436d0efb3006ef5fd2cc088c20d479d60faeaa9d93a6a755882', 'jamieo22@mail.com', '641c589df27f9.jpg', 'USER', NULL, NULL, NULL),
(72, 'JohnRedman22', 'John', 'Redman', '350434bad068a7a4be855bc362d7a4ad6e631e7f5f0d916a2a0452070066d317', 'johnred@gmail.com', '6421bf0c8c173.jpg', 'USER', NULL, NULL, NULL),
(75, 'BrienChef', 'Brandan', 'OBrien', '8f047bd0d0e29c10fe690cdf9268bd5b8f411d20c4e0a91b0e2b7aa28492a15c', 'brien@mail.com', '6421c0ee6bc31.jpg', 'USER', NULL, NULL, NULL),
(76, 'Alex Hamilton', 'Alex', 'Hamilton', 'f001722cdd7f9371daedf315af63a5ffed19ea84a3788bbe7e7069c3ae11f4d0', 'alex@gmail.com', 'avatar.png', 'USER', NULL, NULL, NULL),
(77, 'Miafrowde', 'Mia', 'Frowde', 'dc8633ac62014909ca1c7dde7231020d8773f004b7f0c261e55902b966c9b9d6', 'mia@gmail.com', 'avatar.png', 'USER', NULL, NULL, NULL),
(78, 'Dejan', 'Dejan', 'Bicok', '03836c832366ee1fcb7d7edaa4e388fc2897925aea7fabefa755870e35efec9d', 'dejan@mail.com', 'avatar.png', 'USER', NULL, NULL, NULL),
(80, 'user', 'John', 'Doe', 'e172c5654dbc12d78ce1850a4f7956ba6e5a3d2ac40f0925fc6d691ebb54f6bf', 'user@mail.com', 'avatar.png', 'USER', '', NULL, NULL),
(81, 'user2', 'Johnie', 'Doel', 'e172c5654dbc12d78ce1850a4f7956ba6e5a3d2ac40f0925fc6d691ebb54f6bf', 'user2@mail.com', 'avatar.png', 'USER', 'blocked', NULL, NULL),
(82, 'John', 'John', 'Doe', 'd82494f05d6917ba02f7aaa29689ccb444bb73f20380876cb05d1f37537b7892', 'admin@mail.com', '642fdd7d6d468.jpg', 'ADMIN', '', NULL, NULL),
(84, 'miki', 'miki', 'miki', 'f50727210d3e7e4524bf361bbc993dc71f8ea2ea4093407b3f077a3358c5d98f', 'bicokd@hotmail.com', 'avatar.png', 'USER', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meal_planner`
--
ALTER TABLE `meal_planner`
  ADD PRIMARY KEY (`planner_id`),
  ADD KEY `fk_type_id` (`fk_type_id`),
  ADD KEY `fk_recipe_id` (`fk_recipe_id`),
  ADD KEY `meal_planner_ibfk_1` (`fk_user_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_planner_id` (`fk_planner_id`),
  ADD KEY `fk_type_id` (`fk_type_id`);

--
-- Indexes for table `recipe_reviews`
--
ALTER TABLE `recipe_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `recipe_reviews_ibfk_1` (`fk_recipe_id`);

--
-- Indexes for table `review_message`
--
ALTER TABLE `review_message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `fk_review_id` (`fk_review_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_planner_id` (`fk_planner_id`),
  ADD KEY `fk_recipe_id` (`fk_recipe_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meal_planner`
--
ALTER TABLE `meal_planner`
  MODIFY `planner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=811;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=511;

--
-- AUTO_INCREMENT for table `recipe_reviews`
--
ALTER TABLE `recipe_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `review_message`
--
ALTER TABLE `review_message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meal_planner`
--
ALTER TABLE `meal_planner`
  ADD CONSTRAINT `meal_planner_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meal_planner_ibfk_2` FOREIGN KEY (`fk_recipe_id`) REFERENCES `recipes` (`recipe_id`);

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `recipes_ibfk_2` FOREIGN KEY (`fk_planner_id`) REFERENCES `meal_planner` (`planner_id`);

--
-- Constraints for table `recipe_reviews`
--
ALTER TABLE `recipe_reviews`
  ADD CONSTRAINT `recipe_reviews_ibfk_1` FOREIGN KEY (`fk_recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recipe_reviews_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `review_message`
--
ALTER TABLE `review_message`
  ADD CONSTRAINT `review_message_ibfk_2` FOREIGN KEY (`fk_review_id`) REFERENCES `recipe_reviews` (`review_id`),
  ADD CONSTRAINT `review_message_ibfk_3` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_planner_id`) REFERENCES `meal_planner` (`planner_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`fk_recipe_id`) REFERENCES `recipes` (`recipe_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
