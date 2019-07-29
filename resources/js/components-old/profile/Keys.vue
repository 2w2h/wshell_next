<template>
	<div>
		<b-alert show variant="info">
			Ключи используются для авторизованного доступа к внешним сервисам. <br>
			В большинстве случаев, это <a href="https://ru.wikipedia.org/wiki/OAuth" target="_blank">OAuth токены</a>
		</b-alert>

		<h3>Storages</h3>

		<b-form>
			<b-form-group description="https://developers.google.com/drive/api/v3/enable-sdk">
			    <b-form-input type="password" placeholder="Google Drive"></b-form-input>
			</b-form-group>
			<b-form-group description="https://tech.yandex.ru/oauth">
			    <b-form-input type="password" placeholder="Yandex Disk"></b-form-input>
			</b-form-group>
			<b-form-group description="https://developers.google.com/drive/api/v3/enable-sdk">
			    <b-form-input type="password" placeholder="Mail Cloud"></b-form-input>
			</b-form-group>
	    </b-form>

		<h3>Social</h3>

		<b-form>
			<b-form-group description="https://vk.com/dev/access_token">
			    <b-form-input type="password" placeholder="VK"></b-form-input>
			</b-form-group>
			<b-form-group description="https://developer.github.com/apps/building-oauth-apps/authorizing-oauth-apps">
			    <b-form-input type="password" placeholder="GitHub"></b-form-input>
			</b-form-group>
			<b-form-group description="https://docs.gitlab.com/ee/api/oauth2.html">
			    <b-form-input type="password" placeholder="GitLab"></b-form-input>
			</b-form-group>

		    <b-button variant="orange">Сохранить</b-button>
	    </b-form>
	</div>
</template>