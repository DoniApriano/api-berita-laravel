# Endpoint API

<table style="width: 513.875px; float: left; height: 299px;" border="1">
<tbody>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">method</td>
<td style="width: 227px; height: 24px;">&nbsp;path</td>
<td style="width: 284.875px; height: 24px;">used for</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">&nbsp;/news</td>
<td style="width: 284.875px; height: 24px;">show all news</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">&nbsp;/news/{id}</td>
<td style="width: 284.875px; height: 24px;">show news by id</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">post</td>
<td style="width: 227px; height: 24px;">&nbsp;/news</td>
<td style="width: 284.875px; height: 24px;">create news</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">post</td>
<td style="width: 227px; height: 24px;">&nbsp;/news/{id}</td>
<td style="width: 284.875px; height: 24px;">update news</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">delete</td>
<td style="width: 227px; height: 24px;">/news/{id}</td>
<td style="width: 284.875px; height: 24px;">delete news</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">&nbsp;/latestnews</td>
<td style="width: 284.875px; height: 24px;">show latest news</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/news/{id}/user</td>
<td style="width: 284.875px; height: 24px;">show news by user id</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/news/{id}/categoryPaginate</td>
<td style="width: 284.875px; height: 24px;">show news by category id paginate</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/news/{id}/categoryAll</td>
<td style="width: 284.875px; height: 24px;">show all news by categori id&nbsp;</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/allNewsByFollowing</td>
<td style="width: 284.875px; height: 24px;">show all news by user following</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/search/{search}</td>
<td style="width: 284.875px; height: 24px;">search user/news</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">post</td>
<td style="width: 227px; height: 24px;">/tren/{id}</td>
<td style="width: 284.875px; height: 24px;">&nbsp;add tren news</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/tren</td>
<td style="width: 284.875px; height: 24px;">show tren news</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/comment</td>
<td style="width: 284.875px; height: 24px;">show all comment</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/news/{id}/comment</td>
<td style="width: 284.875px; height: 24px;">show all comment by news id</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">post</td>
<td style="width: 227px; height: 24px;">/comment</td>
<td style="width: 284.875px; height: 24px;">create comment</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">delete</td>
<td style="width: 227px; height: 24px;">/comment/{id}</td>
<td style="width: 284.875px; height: 24px;">delete comment</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/auth/logout</td>
<td style="width: 284.875px; height: 24px;">logout</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">post</td>
<td style="width: 227px; height: 24px;">/auth/changePassword</td>
<td style="width: 284.875px; height: 24px;">change password</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/me</td>
<td style="width: 284.875px; height: 24px;">show porfile by user login</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">post</td>
<td style="width: 227px; height: 24px;">&nbsp;/user/update</td>
<td style="width: 284.875px; height: 24px;">update user profile</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">post</td>
<td style="width: 227px; height: 24px;">/follow</td>
<td style="width: 284.875px; height: 24px;">create follow to user</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">delete&nbsp;</td>
<td style="width: 227px; height: 24px;">/unFollow/{id}</td>
<td style="width: 284.875px; height: 24px;">delete follow to user</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/showFollowing/{id}</td>
<td style="width: 284.875px; height: 24px;">show following by id</td>
</tr>
<tr style="height: 24.6094px;">
<td style="width: 227px; height: 24.6094px;">get</td>
<td style="width: 227px; height: 24.6094px;">/showFollowers/{id}</td>
<td style="width: 284.875px; height: 24.6094px;">show followers by id</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/showFollowingByToken</td>
<td style="width: 284.875px; height: 24px;">show following by user login</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/showFollowingNewsByToken</td>
<td style="width: 284.875px; height: 24px;">show news following by user login</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/checkIfFollowing/{id}</td>
<td style="width: 284.875px; height: 24px;">check if user following or not</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">post</td>
<td style="width: 227px; height: 24px;">/reportComment</td>
<td style="width: 284.875px; height: 24px;">create comment report</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/reportCommentReported</td>
<td style="width: 284.875px; height: 24px;">show report comment by reported</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/reportCommentReporter</td>
<td style="width: 284.875px; height: 24px;">show report comment by reporter</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/category</td>
<td style="width: 284.875px; height: 24px;">show all category</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/bookmarks</td>
<td style="width: 284.875px; height: 24px;">show bookmark by user login</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">post</td>
<td style="width: 227px; height: 24px;">/bookmarks</td>
<td style="width: 284.875px; height: 24px;">create bookmark</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">delete</td>
<td style="width: 227px; height: 24px;">/bookmarks/{newsId}</td>
<td style="width: 284.875px; height: 24px;">delete bookmark</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">post</td>
<td style="width: 227px; height: 24px;">/submission</td>
<td style="width: 284.875px; height: 24px;">create submission</td>
</tr>
<tr style="height: 24px;">
<td style="width: 227px; height: 24px;">get</td>
<td style="width: 227px; height: 24px;">/submission</td>
<td style="width: 284.875px; height: 24px;">show submission</td>
</tr>
</tbody>
</table>
