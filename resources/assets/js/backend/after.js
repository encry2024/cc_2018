
/**
 * Allows you to add data-method="METHOD to links to automatically inject a form
 * with the method on click
 *
 * Example: <a href="{{route('customers.destroy', $customer->id)}}"
 * data-method="update" name="patch_item">Update</a>
 *
 * Injects a form with that's fired on click of the link with a DELETE request.
 * Good because you don't have to dirty your HTML with update forms everywhere.
 */