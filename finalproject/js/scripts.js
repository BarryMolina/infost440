/**
 * @param {String} HTML representing a single element
 * @return {Element}
 */
function htmlToElement(html) {
	var template = document.createElement('template');
	html = html.trim(); // Never return a text node of whitespace as the result
	template.innerHTML = html;
	return template.content.firstChild;
}

// Code to cancel comment update form
function cancelUpdateComment(commentId) {
	let updateFormEl = document.getElementById(`comment-${commentId}-update-form`)
	let commentBodyEl = document.getElementById(`comment-${commentId}-body`)

	updateFormEl.remove()
	commentBodyEl.classList.remove('d-none')


}

// Code to display comment update form in line
function updateComment(blogpost_id, commentId, commentBody) {
	// let comment = document.getElementById('comment-' + commentId)
	const updateFormHtml = `
			<form id="comment-${commentId}-update-form" action="view_blogpost.php?blogpost_id=${blogpost_id}&update_comment_id=${commentId}" method="post">
				<textarea class="form-control mb-3" id="comment_body_input" name="updated_comment_body" rows="5">${commentBody}</textarea>
				<div>
					<button type="button" class="btn btn-secondary" onclick="cancelUpdateComment(${commentId})">Cancel</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		`
	let updateFormEl = htmlToElement(updateFormHtml)
	let commentBodyEl = document.getElementById(`comment-${commentId}-body`)
	commentBodyEl.classList.add('d-none')
	commentBodyEl.insertAdjacentElement('afterend', updateFormEl)
}

// Code to display add new comment form
function addComment(blogpost_id) {

}