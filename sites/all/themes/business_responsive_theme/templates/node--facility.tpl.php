<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>
<?php if (!$page): ?>
  <article id="node-<?php print $node->nid; ?>" class="container <?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<?php endif; ?>
    <?php if (!$page): ?>
      <header>
	<?php endif; ?>
      <?php print render($title_prefix); ?>
      <?php if (!$page): ?>
      <h2 class="title" <?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

      <?php if ($display_submitted): ?>
        <span class="submitted"><?php print $submitted; ?></span>
      <?php endif; ?>

    <?php if (!$page): ?>
      </header>
  <?php endif; ?>

  <div class="content <?php print $classes_array['1']; ?>"<?php print $content_attributes; ?>>
    <?php
      // Hide comments, tags, and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_address_type']);
      //hide($content['group_ratings']);
      //print render($content);
    ?>
    <div class="row">
      <div class="col-sm-12">
        <?php print "<h3>" . $node->field_owner_manager[LANGUAGE_NONE][0]['safe_value'] . "</h3>"; ?>
        <?php hide($content['field_owner_manager']); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
        <?php print render($content['field_contact_name']); ?>
        <?php print render($content['field_contact_phone']); ?>
        <?php print render($content['field_website']); ?>
        <?php print render($content['field_founding_year']); ?>
      </div>
      <div class="col-sm-6">
        <?php print render($content['field_address']); ?>
        <?php print render($content['field_cost_per_month']); ?>
        <?php print render($content['field_capacity_in_beds']); ?>
        <?php print render($content['field_capacity_in_families']); ?>
      </div>
    </div>

    <?php if ($is_admin): ?>
    <div class="row header-row">
      <div class="col-sm-12">
        <h3>Ratings</h3>
      </div>
    </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-sm-6">
        <?php print render($content['group_ratings']); ?>
        <?php print render($content['field_overall_rating']); ?>
        <?php print render($content['field_noise']); ?>
        <?php print render($content['field_neighborhood']); ?>
        <?php print render($content['field_maintenance']); ?>
      </div>
      <div class="col-sm-6">
        <?php print render($content['field_grounds_cleanliness']); ?>
        <?php print render($content['field_safety']); ?>
        <?php print render($content['field_office_staff']); ?>
        <?php print render($content['field_program_structure']); ?>
      </div>
    </div>

    <div class="row header-row">
      <div class="col-sm-12">
        <h3>Intake Policies</h3>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
        <?php print render($content['field_gender']); ?>
      </div>
      <div class="col-sm-3">
        <?php print render($content['field_minimum_age']); ?>
      </div>
      <div class="col-sm-3">
        <?php print render($content['field_maximum_age']); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6">
        <?php print render($content['field_families']); ?>
      </div>
      <?php if (empty($content['field_minimum_stay'])): ?>
        <div class="col-sm-6">
          <?php print render($content['field_maximum_stay']); ?>
        </div>
      <?php elseif (empty($content['field_maximum_stay'])): ?>
        <div class="col-sm-6">
          <?php print render($content['field_minimum_stay']); ?>
        </div>
      <?php else: ?>
        <div class="col-sm-3">
          <?php print render($content['field_minimum_stay']); ?>
        </div>
        <div class="col-sm-3">
          <?php print render($content['field_maximum_stay']); ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <?php print render($content['field_veterans_program']); ?>
        <?php print render($content['field_domestic_violence_program']); ?>
        <?php print render($content['field_conviction_based_bans']); ?>
        <?php print render($content['field_psychiatric_medication']); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <?php print render($content['field_intake_process']); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <?php print render($content['field_apply_from_inside']); ?>
        <?php print render($content['field_letter_or_guarantee']); ?>
      </div>
    </div>

    <div class="row header-row">
      <div class="col-sm-12">
        <h3>Living Situation</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <?php print render($content['field_room_styles']); ?>
        <?php print render($content['field_chore_hours']); ?>
        <?php print render($content['field_meals_included']); ?>
        <?php print render($content['field_laundry']); ?>
        <?php print render($content['field_ada_compliant']); ?>
        <?php print render($content['field_faith_based']); ?>
      </div>
    </div>

    <div class="row header-row">
      <div class="col-sm-12">
        <h3>House Rules</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <?php print render($content['field_sober_living']); ?>
        <?php print render($content['field_blackout_days']); ?>
        <?php print render($content['field_outside_work']); ?>
        <?php print render($content['field_study_outside']); ?>
        <?php print render($content['field_curfew']); ?>
        <?php print render($content['field_overnight']); ?>
        <?php print render($content['field_day_pass_policy']); ?>
      </div>
    </div>

    <div class="row header-row">
      <div class="col-sm-12">
        <h3>Programming and Case Management</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <?php print render($content['field_programming']); ?>
        <?php print render($content['field_programming_location']); ?>
        <?php print render($content['field_programming_details']); ?>
        <?php print render($content['field_case_management']); ?>
        <?php print render($content['field_case_management_location']); ?>
      </div>
    </div>

    <div class="row header-row">
      <div class="col-sm-12">
        <h3>More Information</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <?php print render($content['field_related_documents']); ?>
        <?php print render($content['field_comments']); ?>
        <?php print render($content['field_interactions']); ?>
        <?php print render($content['field_comments_private_']); ?>
      </div>
    </div>

    <?php
      print render($content); ?>

  </div>



  <?php if (!empty($content['links'])): ?>
    <footer>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <?php print render($content['comments']); ?>
<?php if (!$page): ?>
  </article> <!-- /.node -->
<?php endif; ?>
