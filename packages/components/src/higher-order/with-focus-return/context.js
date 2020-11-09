/**
 * WordPress dependencies
 */
import { createContext, useLayoutEffect, useRef } from '@wordpress/element';

const context = createContext( [] );

context.Provider.displayName = 'FocusReturnProvider';
context.Consumer.displayName = 'FocusReturnConsumer';

/**
 * The maximum history length to capture for the focus stack. When exceeded,
 * items should be shifted from the stack for each consecutive push.
 *
 * @type {number}
 */
const MAX_STACK_LENGTH = 100;

export function Provider( { children, className } ) {
	const ref = useRef();
	const focusHistory = useRef( [] );

	// Prepend the focus history with the active element on mount.
	useLayoutEffect( () => {
		focusHistory.current.unshift( ref.current.ownerDocument.activeElement );
	}, [] );

	function onFocus( { target } ) {
		// Push the focused element to the history stack, keeping only unique
		// members but preferring the _last_ occurrence of any duplicates.
		// Uniqueness helps avoid situations where, such as in a constrained
		// tabbing area, the user changes focus enough within a transient
		// element that the stack may otherwise only consist of members pending
		// destruction, at which point focus might have been lost.
		focusHistory.current.forEach( ( element, index ) => {
			if ( element === target ) {
				focusHistory.current.splice( index, 1 );
			}
		} );

		focusHistory.current.push( target );

		const overflow = focusHistory.current.length - MAX_STACK_LENGTH;

		if ( overflow ) {
			focusHistory.current.splice( 0, overflow );
		}
	}

	return (
		<context.Provider value={ focusHistory.current }>
			<div ref={ ref } onFocus={ onFocus } className={ className }>
				{ children }
			</div>
		</context.Provider>
	);
}

export default context;
