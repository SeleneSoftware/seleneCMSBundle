<?php echo "<?php\n"; ?>

namespace <?php echo $namespace; ?>;

<?php echo $use_statements; ?>

class <?php echo $class_name; ?> extends BlogController
{
<?php echo $generator->generateRouteForControllerMethod($route_path, $route_name); ?>
    public function index(): <?php if ($with_template) { ?>Response<?php } else { ?>JsonResponse<?php } ?>

    {
<?php if ($with_template) { ?>
        return $this->render('<?php echo $template_name; ?>', [
            'controller_name' => '<?php echo $class_name; ?>',
        ]);
<?php } else { ?>
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => '<?php echo $relative_path; ?>',
        ]);
<?php } ?>
    }
}
