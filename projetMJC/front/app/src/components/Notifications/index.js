/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';
import { Link } from 'react-router-dom';
/*
 * Local import
 */

/*
 * Code
 */
const Notifications = ({ notifications, displayNotifications, actions }) => {
  const onClick = (evt) => {
    actions.changeNotificationState(evt);
  };
  return (
    <div id="notifications">
      <div onClick={actions.displayNotifications} id="notifications-counter">
        <i className="fa fa-globe" id="notifications-counter-icon" aria-hidden="true"></i>
        <div id="notifications-counter-count">
          {notifications.length}
        </div>
      </div>
      <div
        id="notifications-messages"
        className={classNames(
          'activity-state',
          { 'hide-notif': !displayNotifications },
        )}
      >
        <h1 id="notifications-title">Notifications :</h1>
        {notifications.map((notif) => {
          if (notif.state) {
            return (
              <p key={notif.id} onClick={() => onClick(notif.id)} >
                <Link
                  to={`/ProjectMJC/projetMJC/web/app_dev.php/activity/${notif.id_event}`}
                >
                  - {notif.message}
                </Link>
                <i className="fa fa-times close-notif" aria-hidden="true" />
              </p>
            );
          }
          return '';
        })}
        <p>Tout marquer comme vu</p>
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
