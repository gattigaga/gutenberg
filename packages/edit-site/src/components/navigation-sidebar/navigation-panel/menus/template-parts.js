/**
 * External dependencies
 */
import { map } from 'lodash';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';
import {
	__experimentalNavigationItem as NavigationItem,
	__experimentalNavigationMenu as NavigationMenu,
} from '@wordpress/components';

/**
 * Internal dependencies
 */
import TemplateNavigationItem from '../template-navigation-item';
import { MENU_ROOT, MENU_TEMPLATE_PARTS } from '../constants';
import SearchResults from '../search-results';
import useDebouncedSearch from '../use-debounced-search';

const renderSearchResultItem = ( templatePart ) => (
	<TemplateNavigationItem
		item={ templatePart }
		key={ `wp_template_part-${ templatePart.id }` }
	/>
);

export default function TemplatePartsMenu() {
	const {
		search,
		searchQuery,
		onSearch,
		isDebouncing,
	} = useDebouncedSearch();

	const templateParts = useSelect(
		( select ) =>
			select( 'core' ).getEntityRecords( 'postType', 'wp_template_part', {
				status: [ 'publish', 'auto-draft' ],
				per_page: -1,
			} ),
		[]
	);

	return (
		<NavigationMenu
			menu={ MENU_TEMPLATE_PARTS }
			title={ __( 'Template Parts' ) }
			parentMenu={ MENU_ROOT }
			hasSearch={ true }
			onSearch={ onSearch }
			search={ search }
		>
			{ search && (
				<SearchResults
					items={ templateParts }
					searchQuery={ searchQuery }
					renderItem={ renderSearchResultItem }
					isDebouncing={ isDebouncing }
				/>
			) }

			{ ! search &&
				map( templateParts, ( templatePart ) => (
					<TemplateNavigationItem
						item={ templatePart }
						key={ `wp_template_part-${ templatePart.id }` }
					/>
				) ) }

			{ ! search && templateParts === null && (
				<NavigationItem title={ __( 'Loading…' ) } />
			) }
		</NavigationMenu>
	);
}
