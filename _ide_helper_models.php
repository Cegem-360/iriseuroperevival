<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property-read \App\Models\Workshop|null $workshop
 * @method static \Database\Factories\ActivitySignupFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivitySignup forActivity(string $type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivitySignup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivitySignup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ActivitySignup query()
 */
	class ActivitySignup extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property string $category
 * @property int $sort_order
 * @property bool $is_published
 * @property array<array-key, mixed>|null $translations
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read mixed $translated
 * @method static \Database\Factories\FaqFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq ofCategory(string $category)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq published()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereTranslations($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereUpdatedAt($value)
 */
	class Faq extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $uuid
 * @property string $email
 * @property string $customer_name
 * @property string|null $phone
 * @property string|null $billing_address
 * @property string|null $shipping_address
 * @property string $status
 * @property int $subtotal
 * @property int $discount
 * @property int $total
 * @property int|null $promotion_code_id
 * @property string|null $stripe_session_id
 * @property string|null $stripe_payment_intent
 * @property \Carbon\CarbonImmutable|null $paid_at
 * @property string|null $notes
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read int|float $discount_in_euros
 * @property-read string $formatted_total
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderItem> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\PromotionCode|null $promotionCode
 * @property-read int|float $subtotal_in_euros
 * @property-read int|float $total_in_euros
 * @method static \Database\Factories\OrderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order ofStatus(string $status)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order paid()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereBillingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order wherePromotionCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereShippingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereStripePaymentIntent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereStripeSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Order whereUuid($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $product_name
 * @property int $quantity
 * @property int $unit_price
 * @property int $total
 * @property array<array-key, mixed>|null $attributes
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $product
 * @property-read int|float $total_in_euros
 * @property-read int|float $unit_price_in_euros
 * @method static \Database\Factories\OrderItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|OrderItem whereUpdatedAt($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property int $price
 * @property string $type
 * @property int|null $stock_quantity
 * @property bool $is_active
 * @property string|null $image_path
 * @property array<array-key, mixed>|null $attributes
 * @property int $sort_order
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read string $formatted_price
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read int|float $price_in_euros
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product active()
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product inStock()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product ofType(string $type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereStockQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUuid($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $code
 * @property string $type
 * @property int $value
 * @property int|null $max_uses
 * @property int $used_count
 * @property int|null $min_order_amount
 * @property \Carbon\CarbonImmutable|null $valid_from
 * @property \Carbon\CarbonImmutable|null $valid_until
 * @property bool $is_active
 * @property string|null $description
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read string $formatted_value
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode active()
 * @method static \Database\Factories\PromotionCodeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode valid()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereMaxUses($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereMinOrderAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereUsedCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereValidFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereValidUntil($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PromotionCode whereValue($value)
 */
	class PromotionCode extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $uuid
 * @property string $type
 * @property string $status
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone
 * @property string $country
 * @property string $city
 * @property string|null $ticket_type
 * @property int $ticket_quantity
 * @property numeric|null $amount
 * @property string|null $citizenship
 * @property array<array-key, mixed>|null $languages
 * @property string|null $occupation
 * @property string|null $church_name
 * @property string|null $church_city
 * @property string|null $pastor_name
 * @property string|null $pastor_email
 * @property bool $is_born_again
 * @property bool $is_spirit_filled
 * @property string|null $testimony
 * @property bool $attended_ministry_school
 * @property string|null $ministry_school_name
 * @property string|null $reference_1_name
 * @property string|null $reference_1_email
 * @property string|null $reference_2_name
 * @property string|null $reference_2_email
 * @property string|null $stripe_session_id
 * @property string|null $stripe_payment_intent
 * @property \Carbon\CarbonImmutable|null $paid_at
 * @property \Carbon\CarbonImmutable|null $approved_at
 * @property int|null $approved_by
 * @property \Carbon\CarbonImmutable|null $rejected_at
 * @property int|null $rejected_by
 * @property string|null $rejection_reason
 * @property string|null $admin_notes
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property int|null $user_id
 * @property string|null $stripe_customer_id
 * @property string|null $invited_by
 * @property \Carbon\CarbonImmutable|null $reference_1_contacted_at
 * @property string|null $reference_1_status
 * @property string|null $reference_1_response
 * @property \Carbon\CarbonImmutable|null $reference_2_contacted_at
 * @property string|null $reference_2_status
 * @property string|null $reference_2_response
 * @property \Carbon\CarbonImmutable|null $confirmation_email_sent_at
 * @property-read string $formatted_amount
 * @property-read string $full_name
 * @property-read bool $is_approved
 * @property-read bool $is_paid
 * @property-read bool $is_pending
 * @property-read bool $is_rejected
 * @property-read string $status_badge
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration approved()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration attendees()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration byCountry(string $country)
 * @method static \Database\Factories\RegistrationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration forUser(\App\Models\User $user)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration ministryTeam()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration paid()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration pendingApproval()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration volunteers()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereAdminNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereAttendedMinistrySchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereChurchCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereChurchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereCitizenship($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereConfirmationEmailSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereInvitedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereIsBornAgain($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereIsSpiritFilled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereMinistrySchoolName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration wherePastorEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration wherePastorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereReference1ContactedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereReference1Email($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereReference1Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereReference1Response($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereReference1Status($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereReference2ContactedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereReference2Email($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereReference2Name($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereReference2Response($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereReference2Status($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereRejectedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereRejectedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereRejectionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereStripeCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereStripePaymentIntent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereStripeSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereTestimony($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereTicketQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereTicketType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Registration whereUuid($value)
 */
	class Registration extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property \Carbon\CarbonImmutable $day
 * @property \Carbon\CarbonImmutable $start_time
 * @property \Carbon\CarbonImmutable $end_time
 * @property string $type
 * @property int|null $speaker_id
 * @property string|null $location
 * @property array<array-key, mixed>|null $translations
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property bool $is_published
 * @property int $sort_order
 * @property-read \App\Models\Speaker|null $speaker
 * @property-read mixed $translated
 * @method static \Database\Factories\ScheduleItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem ofType(string $type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem onDay($day)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem published()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereSpeakerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereTranslations($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ScheduleItem whereUpdatedAt($value)
 */
	class ScheduleItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $uuid
 * @property string $slug
 * @property string $name
 * @property string|null $title
 * @property string|null $organization
 * @property string|null $country
 * @property string|null $bio
 * @property string|null $photo_path
 * @property string $type
 * @property bool $is_featured
 * @property int $sort_order
 * @property array<array-key, mixed>|null $social_links
 * @property array<array-key, mixed>|null $translations
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ScheduleItem> $scheduleItems
 * @property-read int|null $schedule_items_count
 * @property-read mixed $translated
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Workshop> $workshops
 * @property-read int|null $workshops_count
 * @method static \Database\Factories\SpeakerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker featured()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker ofType(string $type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereOrganization($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker wherePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereSocialLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereTranslations($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Speaker whereUuid($value)
 */
	class Speaker extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $logo_path
 * @property string|null $website_url
 * @property string $tier
 * @property int $sort_order
 * @property bool $is_active
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor byTierPriority()
 * @method static \Database\Factories\SponsorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor ofTier(string $tier)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereLogoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereTier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Sponsor whereWebsiteUrl($value)
 */
	class Sponsor extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $uuid
 * @property string $ticket_type
 * @property string $pricing_tier
 * @property int $price
 * @property string $label
 * @property string|null $description
 * @property bool $is_active
 * @property int $sort_order
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read string $formatted_price
 * @property-read int|float $price_in_euros
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice active()
 * @method static \Database\Factories\TicketPriceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice forTier(string $tier)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice forType(string $type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice wherePricingTier($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice whereTicketType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TicketPrice whereUuid($value)
 */
	class TicketPrice extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Carbon\CarbonImmutable|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property bool $is_admin
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Registration> $registrations
 * @property-read int|null $registrations_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Filament\Models\Contracts\FilamentUser {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $uuid
 * @property string $slug
 * @property string $title
 * @property string|null $short_description
 * @property string|null $description
 * @property array<array-key, mixed>|null $benefits
 * @property int|null $speaker_id
 * @property string|null $image_path
 * @property int|null $capacity
 * @property int $duration_minutes
 * @property string $difficulty_level
 * @property array<array-key, mixed>|null $requirements
 * @property bool $is_published
 * @property int $sort_order
 * @property array<array-key, mixed>|null $translations
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read string $formatted_duration
 * @property-read \App\Models\Speaker|null $speaker
 * @property-read mixed $translated
 * @method static \Database\Factories\WorkshopFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop ofDifficulty(string $level)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop published()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereDifficultyLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereDurationMinutes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereSpeakerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereTranslations($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workshop whereUuid($value)
 */
	class Workshop extends \Eloquent {}
}

