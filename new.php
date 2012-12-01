<div class="modal hide fade">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>Compose New Message</h3>
          </div>
          <div class="modal-body">
            <!-- <p>One fine body…</p> -->
            <form class="form-block" action="smtp.php" method="POST">
              <input type="text" name="to" placeholder="To" class="input-block-level"/>
              <!-- <br> -->
              <input type="text" name="subject" placeholder="Subject" class="input-block-level"/>

              <textarea name="body" class="input-block-level" rows=4 placeholder="Message"></textarea>

              <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
              <button type="submit" class="btn btn-primary">Send!</button>

            </form>
          </div>

          <!-- <div class="modal-footer">
            <a href="#" class="btn btn-primary">Save changes</a>
          </div> -->
        </div>