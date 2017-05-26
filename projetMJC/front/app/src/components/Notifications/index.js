/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';
/*
 * Local import
 */

/*
 * Code
 */
const Notifications = ({ notifications, displayNotifications, actions }) => {
  console.error(displayNotifications);
  return (
    <div id="notifications">
      <div onClick={actions.displayNotifications} id="notifications-counter">
        <div id="notifications-counter-count">
          {notifications.length}
        </div>
      </div>
      <i className="fa fa-circle" aria-hidden="true"></i>
      <div
        id="notifications-messages"
        className={classNames(
          'activity-state',
          { 'hide-notif': !displayNotifications },
        )}
      >
        <p id="notifications-title">Notifications :</p>
        {notifications.map(notif => (
          <p key={notif.id}>{notif.message}</p>
        ))}
      </div>
    </div>
  );
};

Notifications.propTypes = {
  notifications: PropTypes.arrayOf(PropTypes.object.isRequired).isRequired,
  displayNotifications: PropTypes.bool.isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default Notifications;