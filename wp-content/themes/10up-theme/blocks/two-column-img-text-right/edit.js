/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	URLInputButton,
	useBlockProps,
} from '@wordpress/block-editor';

import { PanelBody, Button, TextControl, TextareaControl } from '@wordpress/components';

/**
 * Edit component.
 * See https://wordpress.org/gutenberg/handbook/designers-developers/developers/block-api/block-edit-save/#edit
 *
 * @param {object}   props                  The block props.
 * @param {object}   props.attributes       Block attributes.
 * @param {string}   props.attributes.title Custom title to be displayed.
 * @param {string}   props.className        Class name for the block.
 * @param {Function} props.setAttributes    Sets the value for block attributes.
 * @returns {Function} Render the edit screen
 */
const TwoColumnImgEdit = (props) => {
	const { attributes, setAttributes, clientId } = props;
	const { imageUrl, title, description, buttonText, buttonUrl, blockId } = attributes;
	if (!blockId) {
		setAttributes({ blockId: clientId });
	}

	const blockProps = useBlockProps();

	return (
		<div {...blockProps} className="card-block">
			<InspectorControls>
				<PanelBody title={__('Card Settings', 'mytheme')} initialOpen>
					<div className="panel-card-image">
						<MediaUploadCheck>
							<MediaUpload
								onSelect={(media) => setAttributes({ imageUrl: media.url })}
								allowedTypes={['image']}
								render={({ open }) => (
									<Button onClick={open} variant="secondary">
										{imageUrl ? (
											<img
												src={imageUrl}
												alt="Card"
												style={{ maxWidth: '100%' }}
											/>
										) : (
											__('Upload Image', 'mytheme')
										)}
									</Button>
								)}
							/>
						</MediaUploadCheck>
					</div>

					<TextControl
						label={__('Title')}
						value={title || ''}
						onChange={(value) => setAttributes({ title: value })}
					/>

					<TextareaControl
						label={__('Description')}
						value={description || ''}
						onChange={(value) => setAttributes({ description: value })}
						placeholder={__('Enter a brief description', 'mytheme')}
					/>

					<TextControl
						label={__('Button Text')}
						value={buttonText || ''}
						onChange={(value) => setAttributes({ buttonText: value })}
					/>
					<URLInputButton
						label={__('Button URL')}
						url={buttonUrl || ''}
						onChange={(value) => setAttributes({ buttonUrl: value })}
					/>
				</PanelBody>
			</InspectorControls>
			<div className="two-column-img-text-right container">
				<div className="card-image">
					{imageUrl ? (
						<img
							src={imageUrl}
							alt={__('Card Image', 'mytheme')}
							style={{ maxWidth: '100%' }}
						/>
					) : (
						<div className="placeholder-image">
							{__('No image selected', 'mytheme')}
						</div>
					)}
				</div>
				<div className="card-content">
					<h2 className="card-title">{title || __('Enter title...', 'mytheme')}</h2>
					<p className="card-description">
						{description || __('Enter description...', 'mytheme')}
					</p>
					<a
						href={buttonUrl || '#'}
						className="button-primary"
						target="_blank"
						rel="noopener noreferrer"
					>
						{buttonText || __('Button text...', 'mytheme')}
					</a>
				</div>
			</div>
		</div>
	);
};
export default TwoColumnImgEdit;
